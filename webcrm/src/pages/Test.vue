<template>
  <div class="m-panel close">
    <div class="mp-l bg-amber-1">
      <q-btn label="Test 1" color="light-blue-7" @click="butTest" />
      <q-btn label="Test 2" color="light-blue-7" @click="pushTest" />
    </div>
    <div class="mp-r bg-brown-1"></div>
  </div>
</template>

<script>
import bbApi from '@/lib/api'

export default {
  setup() {

    function butTest() {
      bbApi.trans('test/test1').then((resp) => {
        console.log(resp);
      })
    }

    function pushTest() {
      bbApi.trans('test/test2').then((resp) => {
        console.log(resp);
      })
    }

    return {
      butTest,
      pushTest
    }
  }
}
</script>