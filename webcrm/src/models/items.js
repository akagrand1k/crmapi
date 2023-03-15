import { reactive } from 'vue'

import bbApi from '@/lib/api'

let items = []
let api = []

const getItems = async (type, url) => {
  //if(items[type] && items[type].length > 0){
  if(items[type]){
    console.log('[mItems] load from Model')
    return Promise.resolve(items[type])
  }

  /* 
  const cache = JSON.parse(window.localStorage.getItem('$_bbAPPS'))
  console.log('[mApps] loadFromLS()', cache ? true : false)
  if(cache){
    apps = cache
    return Promise.resolve(apps)
  } 
  */
  api[type] = url ?? type
  const respone = await bbApi.trans(api[type])
  if (respone.status === 'success') {
    items[type] = reactive(respone.data)
    // window.localStorage.setItem('$_bbAPPS', apps)
    return Promise.resolve(items[type])
  }

  return Promise.resolve([])
}

export default function useItems () {
  return { getItems }
}
