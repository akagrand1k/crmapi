<style scoped>
</style>

<template>
  <q-expansion-item>
  <!-- <q-expansion-item v-model="expanded" :label="placesCount(places.length)" v-if="places.length > 0"> -->
    <q-card>
      <q-card-section v-for="place in places" :key="place.id" class="place">
        <div class="row">
          <div class="col">
              <hot-edit :data="place" field="name" @save="placePatch" />
          </div>
          <div class="col-auto">
            <q-btn color="black" flat icon="edit" />
            <q-btn color="black" @click="placeDelete(place)" flat icon="remove_circle_outline" />
          </div>
        </div>
      </q-card-section>
    </q-card>
  </q-expansion-item>


</template>

<script>
  import bbApi from '@/lib/api'
  import HotEdit from '@/components/HotEdit.vue'

  export default {
    components: {
      HotEdit
    },

    props: ['places'],
    setup(props) {
      return {
        placesCount(count){
          return count + ' кабинета'
        },
        // expanded: false
        async placePatch(patch) {
          const resp = await bbApi.trans("places/patch", patch);
          if (resp.status === "success") {
            
          }
        },
        placeDelete(filial) {
          bbApi.trans("place/delete", {
            filial_id: filial.id
          }).then((resp) => {
            if (resp.status === "success") {
              bbApi.trans('place', {
                company_id: props.company.id
              }).then((resp) => {
                if (resp.status === 'success') {
                  props.filials.value = resp.data;
                  console.log('place=', props.filials)
                }
              })
            }
          })

        },
      }
    },
  }
</script>