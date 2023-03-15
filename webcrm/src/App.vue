<style>
/*   
  @font-face { font-family: Comfortaa;  src: url(/fonts/Comfortaa-VariableFont_wght.ttf); }
  @font-face { font-family: Exo2; src: url(/fonts/Exo2-VariableFont_wght.ttf); } 
*/
  body #app{font-family: Verdana;}
  .crm-show-side-on-hover .q-item__section--side {visibility: hidden;}
  .crm-show-side-on-hover:hover .q-item__section--side {visibility:visible;}
</style>

<template>
  <component :is="layout" />
</template>

<script>
import { computed, defineAsyncComponent, inject, ref, watch } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useStore } from 'vuex'
import token from '@/lib/token'

export default {

  components: { 
    // import LayEmpty from '@/layouts/LayEmpty.vue' import LayMain from '@/layouts/LayMain.vue'
    LayEmpty: defineAsyncComponent(() => import( /* webpackChunkName: "layout-empty" */ '@/layouts/LayEmpty.vue')), 
    LayMain: defineAsyncComponent(() => import( /* webpackChunkName: "layout-main" */ '@/layouts/LayMain.vue')) 
  },

  setup() {
    function log(...msg) {
      return;
      console.info(
        '%capp', 'background-color:SteelBlue; color:white; padding:2px 4px; border-radius:5px;',
        ...msg
      )
    }

    const router = useRouter()
    const route = useRoute()
    // TODO: Переименовать initialRoute более понятно
    const initialRoute = computed(() => store.getters['app/routes'])//ref('unresolved')

    const store = useStore()

    const notify = inject('bbNotify')
    const loader = inject('bbLoader')

    const error = computed(() => store.getters['error/error'])
    const offline = computed(() => store.getters['error/offline'])

    watch(() => error, (first, second) => {
      notify.error(first)
    })
    watch(() => offline, (first, second) => {
      loader.error(first)
    })

    const layout = computed(() => {

      // На момент запуска setup() route.name = undefined
      if( !route.name ){
        log('Layout(',route.name,') = FALSE')
        return false
      }

      // В Роуторе не нашлось нужного Маршрута (router.resolve().name == '404')
      if(route.name && route.name == '404' && initialRoute.value == 'unresolved'){
        log('Layout(',route.name,') initialRoute =', initialRoute.value)
        return false
      }
      // в appInit после загрузки Маршрутов с сервера:
      // - либо переходим на нужный загруженный Маршрут
      // - либо (initialRoute.value = 'resolved') среди загруженных Маршрутов нужный не найден

      // Обязательно ждем Ответ с сервера если требуется авторизация
      const auth = route.meta.auth || 'user'
      if( !store.getters['auth/loaded'] && auth == 'user' ) {
        log('Layout(',route.name,') = FALSE -> Loaded =',store.getters['auth/loaded'],'& Auth =', auth)
        return false
      }

      log('Layout(',route.name,') =',(route.meta.layout || 'main'),'-> Loaded =',store.getters['auth/loaded'],'& Auth =', auth)
      return 'lay-' + (route.meta.layout || 'main')
    })

    function appLoad()
    {
      if( token.exist() ) 
      {
        if( !store.getters['auth/loaded'] )
        {
          loader.info('Загрузка системных данных...')
          // log('store.dispatch(auth/signInit)')
          store.dispatch('auth/signInit').then((respone) => {

            if( respone.status === 'success' )
            {
              // Прошла первичная инициализация
              log('dispatch(auth/signInit) success, run appInit()')
              appInit()           
              loader.hide()
            } 
            else if( respone.status === 'error' ) 
            {
              // Ошибка инициализации
              // log('signInit error!')
              store.dispatch('signOut')
              router.push({ name: 'Sign In' })
              loader.hide()
            }else{
              log('signInit Offline!')
            }
          })
        } 
      }else{
        log('signInit !token.exist')
      }
    }
    appLoad()

    function appInit()
    {
      function loadComponent(name){
        return () => import(/* webpackChunkName: "[request]" */ `@/pages/${name}.vue`)
      }
      for (let app of Object.values(store.getters['app/apps'])) {
        router.addRoute({...app.config, ...{component: loadComponent(app.config.component)}})
      }
      log('router.addRoute DONE route.name =', route.name)
      //store.commit('auth/loaded')
      
      // Если Маршрут не найден
      if (route.name == '404') {
        // Ищем в загруженных
        let resolved = router.resolve(route.fullPath)
        if(resolved.name != '404') {
          // нашли нужный маршрут - идет по нему
          log('appInit router.push(',route.fullPath,') route.name =', route.name)
          router.push(route.fullPath)
        }else{
          // пусть грузить 404
          initialRoute.value = 'resolved'
          log('appInit resolved.name == 404')
        }
      }
    }

    return {
      layout
    }
  }
}
</script>

