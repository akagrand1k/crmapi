<template>
  <div class="crm-side-panel bg-white" :class=cssClass >   
    <div class="crm-side-title">
      <!-- Заголовок -->
      <q-btn 
        round color="secondary" icon="first_page" style="font-size:10px;" class="float-right" 
        @click="close()"
      />
    </div>
    <q-list>
      <q-item v-for="(item, idx) of items" 
        :to="item.route" 
        @click="close()"
        :key="idx" 
        clickable v-ripple  exact
      >
        <q-item-section>{{item.title}}</q-item-section>
      </q-item>
    </q-list>
  </div>
</template>

<script>
import { computed } from 'vue'
import { useStore } from 'vuex'

export default {
  
  setup() {

    const store = useStore()

    function close() {
      // console.log('title', title)
      store.commit('navbar/hide')
    }
    
    return {
      close,
      cssClass: computed(() => store.getters['navbar/show'] ? 'open' : 'close'),
      items: computed(() => store.getters['navbar/items'])
    }
  }
}
</script>

<style>
  .crm-side-panel {
    position: fixed;
    top: 0;
    left: -360px;
    transition: all 0.5s;   
    width: 320px;
    height: 100vh;
    box-shadow: 3px 0 6px rgba(0,0,0,0.4);
    padding: 10px 5px 10px 10px;
  }
  .crm-side-title {
    font-size: 20px;
    padding-bottom: 10px;
    margin-bottom: 20px;
  }
  .crm-side-panel.close {
    left:-360px;
  }
  .crm-side-panel.open {
    left:3.5rem;
  }
</style>