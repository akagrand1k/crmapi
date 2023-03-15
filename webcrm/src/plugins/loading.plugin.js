import { Loading, QSpinnerClock, QSpinnerComment } from 'quasar'

export default {
  install: (app, options) => {

    if(!app.config.globalProperties.$bb) {
      app.config.globalProperties.$bb = {}
    }
    
    if(!app.config.globalProperties.$bb.loading) {
      app.config.globalProperties.$bb.loading = {}
    }

    app.config.globalProperties.$bb.loading.show = config => {
      Loading.show(config)
    }
    app.config.globalProperties.$bb.loading.hide = () => {
      Loading.hide()
    }
    app.config.globalProperties.$bb.loading.info = html => {
      Loading.show({
        backgroundColor: 'white',
        spinner: QSpinnerClock,
        spinnerColor: 'blue',
        messageColor: 'indigo',
        message: html
      })
    }
    app.config.globalProperties.$bb.loading.offline = config => {
      Loading.show({ ...{
        backgroundColor: 'red',
        spinner: QSpinnerComment,
        //spinnerSize: 0,
        spinnerColor: 'red',
        messageColor: 'pink-10'
      }, ...config})
    }

    app.provide('bbLoader', app.config.globalProperties.$bb.loading)
  }
}
