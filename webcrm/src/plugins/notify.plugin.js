import { Notify } from 'quasar'

export default {
  // position: top-left top-right bottom-left bottom-right top bottom left right center

  install: (app, options) => {

    if(!app.config.globalProperties.$bb) {
      app.config.globalProperties.$bb = {}
    }
    
    if(!app.config.globalProperties.$bb.notify) {
      app.config.globalProperties.$bb.notify = {}
    }

    app.config.globalProperties.$bb.notify.show = config => {
      return Notify.create(config)
    }

    
    app.config.globalProperties.$bb.notify.message = html => {
      return Notify.create({
        classes: 'glossy',
        type: 'positive',
        message: html,
        multiLine: true,
        timeout: 5000
      })
    }
    app.config.globalProperties.$bb.notify.error = code => {
      return Notify.create({
        classes: 'glossy',
        type: 'negative',
        message: code,
        multiLine: true,
        timeout: 5000
      })
    }
    app.config.globalProperties.$bb.notify.offline = config => {
      console.log('$bb.notify.offline config =',config)
      return  Notify.create({ ...{
        classes: 'glossy',
        group: false,
        html: true,
        type: 'negative',
        position: 'center'
      }, ...config})
    }
    app.provide('bbNotify', app.config.globalProperties.$bb.notify)
  }
}
