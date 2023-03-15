import { ref, computed } from 'vue'

const cssClass = ref('close')
const items = ref([])

const getItems = computed(() => {
  //console.log(i.value, 'get', state1.value)
  return items.value
})

const setItems = (arr) => {
  items.value = arr
  //console.log(i.value, 'set', val)
}

const show = () => {
  cssClass.value = 'open'
  console.log('[show] cssClass', cssClass)
}

const hide = () => {
  cssClass.value = 'close'
}

export default function useNavBarSlide () {
  return { cssClass, show, hide, setItems, getItems }
}