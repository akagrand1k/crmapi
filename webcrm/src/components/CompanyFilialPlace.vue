<template>
  <!-- <q-expansion-item> -->
  <q-expansion-item :label="placesCount(places.length)">
    <q-card>
      <q-card-section v-for="place in places" :key="place.id" class="place">
        <div class="row">
          <div class="col">
            <hot-edit :data="place" field="name" @save="placePatch" />
          </div>
          <div class="col-auto">
            <q-btn color="black" round flat icon="more_vert">
              <q-menu anchor="bottom end" self="top end">
                <q-list>
                  <q-item clickable>
                    <q-item-section avatar>
                      <q-icon color="primary" name="edit" />
                    </q-item-section>
                    <q-item-section>Редактировать</q-item-section>
                  </q-item>

                  <q-item clickable @click="deletePlace(place)">
                    <q-item-section avatar>
                      <q-icon color="primary" name="remove_circle_outline" />
                    </q-item-section>
                    <q-item-section>Удалить</q-item-section>
                  </q-item>
                </q-list>
              </q-menu>
            </q-btn>
          </div>
        </div>
      </q-card-section>
    </q-card>
  </q-expansion-item>
</template>

<script>
import api from "@/lib/api";
import HotEdit from "@/components/HotEdit.vue";
import {inject} from 'vue'

export default {
  components: {
    HotEdit,
  },

  props: ["places"],
  setup(props, context) {
    var filials =  inject('filials')

    return {
      filials,
      placesCount(count) {
        console.log(count);
        return count + " кабинета";
      },
      async placePatch(patch) {
        const resp = await api.trans("places/patch", patch);
        if (resp.status === "success") {
        }
      },
      deletePlace(place) {
        api
          .trans("places/delete", {
            id: place.id,
          })
          .then((resp) => {
            if (resp.status === "success") {
              filials.value.map(function (filial) {
                if (filial.id == place.filial_id) {
                  console.log(filial);
                  if (filial.places !== null) {
                    filial.places = filial.places.filter((i) => i.id !== place.id);
                  }
                }
                return filial;
              });
            }
          });
      },
    };
  },
};
</script>