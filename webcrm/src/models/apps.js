import { ref } from 'vue'

import bbApi from '@/lib/api'

const loaded = ref(false)
let apps = []

const installed = async () => {
  if(apps.length > 0){
    console.log('[mApps] load from Model')
    return Promise.resolve(apps)
  }

  /* 
  const cache = JSON.parse(window.localStorage.getItem('$_bbAPPS'))
  console.log('[mApps] loadFromLS()', cache ? true : false)
  if(cache){
    apps = cache
    return Promise.resolve(apps)
  } 
  */
    
  const respone = await bbApi.trans('apps')
  if (respone.status === 'success') {
    apps = respone.data
    // window.localStorage.setItem('$_bbAPPS', apps)
    return Promise.resolve(apps)
  }

  return Promise.resolve([])
}

export default function useApps () {
  return { installed }
}
