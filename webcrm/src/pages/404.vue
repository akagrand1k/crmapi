<template>
  <q-page class="bg-grey-1 window-height window-width row justify-center items-center">
    <div class="column">
      <div class="row">
        <q-card square bordered class="q-pa-lg">

          <h5 style="text-align: center;">Страница не найдена</h5>
          <q-btn 
            label="< Вернуться в CRM"
            @click="goBack" 
            size="22px" class="q-px-xl q-py-xs" color="purple" 
          />

        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script>
export default {

  setup() {
    
    function goBack () { 
      window.history.length > 2 ? router.go(-1) : router.push('/') 
    }

    return {
      goBack
    }
  }
}
</script>