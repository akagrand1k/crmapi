import axios from 'axios'
import router from '@/router'
import store from '@/store'
import token from '@/lib/token'

const baseUrl = process.env.VUE_APP_BB_SERVER

//console.log(process.env)

if (!window.$bbServer) {
  window.$bbServer = axios.create({
    baseURL: baseUrl
  })
  const authInterceptor = config => {
    if (token.exist()) {
      config.headers.Authorization = `Bearer ${token.get()}`
    }
    return config
  }
  window.$bbServer.interceptors.request.use(authInterceptor)

  /** Adding the response interceptors */
  window.$bbServer.interceptors.response.use(
    response => {
      // console.log('axios respone =', response)
      return {
        status: 'success',
        data: response.data.data || response.data
        // data: response.data
      }
    },
    (error) => {
      // debugger
      // error.toJSON = undefined
      // console.log('Axios error', JSON.stringify(error, null, 2))
      const e = error.response ? {
        status: 'error',
        statusCode: error.response.status,
        statusText: error.response.statusText,
        // statusMessage: error.message,
        message: error.response.data.message || '',
        errors: error.response.data.errors || ''
      } : {
        status: 'offline'
      }
      // const e = {
      //   status: error.response ? 'error' : 'offline',
      //   data: error
      // }
      // if(e.status == 'error')
      // {
      //   e.data = error.response.data.message
      // }
      /** Do something with response error */
      return Promise.resolve(e)
    }
  );
}

const server = window.$bbServer

function timeout(ms) {
  return new Promise(resolve => setTimeout(resolve, ms))
}

export default {
  
  upload (fileData) {
    server.post(`${baseUrl}logo/user`, fileData, {
      headers: { 'Content-Type': 'multipart/form-data' }
    }).then((response) => {
      console.log(response.data)
    })
  },

  async rest (data, method = 'post') {
    return this.trans(router.currentRoute.path, data, method)
  },

  ajax (config, callback) {
    server(config)
    .then((response) => {
      callback(response)
    }, (error) => {
      console.log(error)
    })
  },

  // mode = ['retry', 'stop']
  async trans (url, data = {}, method = 'post', mode = 'retry') {
    // console.log('trans');
    const resp = await server({ method, url, data })

    if (resp.status === 'offline') {
      const msg = '<strong>Нет соединения с Сервером.</strong></br>'
      if (mode == 'retry') {
        store.commit('error/setOffline', {
          message: msg + 'Повторная проверка соединения...'
        })
        await timeout(3000) 
        return await this.trans(url, data, method, 'stop')
      } else {
        store.commit('error/setOffline', {
          message: msg + 'Проверьте соединение с сетью / Прегрузите страницу'
        })
        return Promise.resolve({status: 'offline'})
      }
    }else if (resp.status === 'error') {
      // store.commit('error/setError', `Sign In ERROR: ${resp.data.name}: ${resp.data.message}`)
      store.commit('error/setError', resp.message)
    }
    //console.log('trans', resp)
    return resp
  }
}
