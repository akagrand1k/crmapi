import { createRouter, createWebHistory } from 'vue-router'
import token from '@/lib/token'


const routes = [
  {
    path: '/:pathMatch(.*)*',
    name: '404',
    meta: { title: 'Страница не найдена', layout: 'empty', auth: 'guest' },
    component: () => import(/* webpackChunkName: "home" */ '../pages/404.vue')
  },{
    path: '/sign-up-owner',
    name: 'Sign Up Owner',
    meta: { title: 'Регистрация Школы', layout: 'empty', auth: 'guest' },
    component: () => import(/* webpackChunkName: "signup" */ '../pages/auth/Signup.vue'),
    props: {roles: ['owner']}
  },{
    path: '/sign-up',
    name: 'Sign Up',
    meta: { title: 'Регистрация Студента', layout: 'empty', auth: 'guest' },
    component: () => import(/* webpackChunkName: "signup" */ '../pages/auth/Signup.vue')
  },{
    path: '/sign-in',
    name: 'Sign In',
    meta: { title: 'Вход в систему', layout: 'empty', auth: 'guest-only' },
    component: () => import(/* webpackChunkName: "signin" */ '../pages/auth/Signin.vue')
  },{
    path: '/apps',
    name: 'Apps',
    meta: { title: 'Модули' },
    component: () => import(/* webpackChunkName: "apps" */ '../pages/Apps.vue')
  },{
    path: '/',
    name: 'Home',
    meta: { title: 'Главная' },
    component: () => import(/* webpackChunkName: "home" */ '../pages/Home.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

// console.log('process.env.BASE_URL', process.env.BASE_URL)
function log(...msg) {
  return;
  console.info(
    '%crouter', 'background-color:MediumSeaGreen; color:white; padding:2px 4px; border-radius:5px;',
    ...msg
  )
}

router.beforeEach((to, from, next) => {
  // https://github.com/arunredhu/vuejs_boilerplate/blob/master/src/app/app-routes.js
  // TODO: query: { redirect: to.fullPath } https://router.vuejs.org/ru/guide/advanced/meta.html
  // console.log('router.beforeEach to = ', to)
  // const auth = to.matched.some(rec => rec.meta.auth)
  // console.log('router.beforeEach to.matched = ', to.matched)

  log(
    //'[router.beforeEach] from = ', from.name,
    'to =', to.name, 
    'meta.auth =', to.meta.auth || 'required', 
    'tokens =', token.exist()
  )

  document.title = `${to.meta.title } | `

  if (to.meta.auth === 'guest-only') {  // только для гостей
    if (token.exist()) {                       // если есть ключи то иди на главную
      log('auth = Guest-only & tokens(TRUE) -> next({name: Home})')
      next({name: 'Home'})
    } else {                            // если нет ключей - то ок
      log('auth = Guest-only & tokens(FALSE) -> next()')
      next()
    }
  } else if (to.meta.auth === 'guest') { // страница доступна всем - иди на здоровье
    log('auth = Guest -> next()')
    next()
  } else {                              // требует авторизации (по умолчанию)
    if (!token.exist()) {                      // а ключей нет - то Логин
      log('auth = User && !token.exist -> next({name: Sign In})')
      next({name: 'Sign In'})
    } else {                            // ключи есть - попытайся авторизоваться через LayMain
      log('auth = User && token.exist -> next()');
      next()
    }
  }
})

export default router

