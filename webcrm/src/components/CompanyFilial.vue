<template>
  <q-card class="filial">
    <q-card-section class="bg-grey-4 text-black">
      <div class="row items-center no-wrap">
        <div class="col">
          <div class="text-h6">
            <hot-edit :data="filial" field="name" @save="filialPatch" />
          </div>
        </div>
        <div class="col-auto">
          <q-btn
            color="black"
            label="Кабинет"
            @click="addNewPlace(filial)"
            flat
            icon="add_circle_outline"
          />
          <q-btn color="black" round flat icon="more_vert">
            <q-menu anchor="bottom end" self="top end">
              <q-list>
                <q-item clickable @click="$emit('delete', filial)">
                  <q-item-section avatar>
                    <q-icon color="primary" name="remove_circle_outline" />
                  </q-item-section>
                  <q-item-section>Филиал</q-item-section>
                </q-item>
              </q-list>
            </q-menu>
          </q-btn>
        </div>
      </div>
    </q-card-section>

    <q-card-section
      class="bg-light place text-black"
      v-if="filial.places && filial.places.length > 0"
    >
      <company-filial-place :places="filial.places"/>
    </q-card-section>
  </q-card>
</template>


<script>
import api from "@/lib/api";
import HotEdit from "@/components/HotEdit.vue";
import CompanyFilialPlace from "@/components/CompanyFilialPlace.vue";
// import CompanyFilialPlace from "@/components/CompanyFilialPlaceFun.vue";

export default {
  components: {
    HotEdit,
    CompanyFilialPlace,
  },

  props: ["filial"],
  emits: ["delete", "addNewPlace"],
  setup(props, context) {
    return {
      filialPatch(patch) {
        api.trans("filials/patch", patch).then((resp) => {});
      },
      addNewPlace(filial) {
        api
          .trans("places/create", {
            filial_id: filial.id,
          })
          .then((resp) => {
            context.emit("addNewPlace", resp.data);
          });
      },
    };
  },
};
</script>

<style scoped>
.filial {
  margin-top: 25px;
}
.place {
  padding: 3px 10px 3px 0;
}
</style>

