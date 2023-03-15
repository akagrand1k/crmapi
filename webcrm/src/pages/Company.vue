<template>
  <div class="q-pa-sm">
    <q-btn label="test" @click="test" />
    <q-btn label="test1" @click="test1" />
    <q-card>
      <q-card-section class="bg-primary text-white">
        <div class="row items-center no-wrap">
          <div class="col">
            <div class="text-h6">
              <hot-edit
                :data="company"
                field="name"
                dispatch="company/patch"
                @save="companyName"
              />
            </div>
          </div>
          <div class="col-auto">
            <q-btn
              label="Филиал"
              color="white"
              flat
              icon="add_circle_outline"
              @click="addNewFilial"
            />
          </div>
        </div>
      </q-card-section>
    </q-card>

    <company-filial
      v-for="filial in filials"
      :key="filial.id"
      :filial="filial"
      @delete="deleteFilial"
      @addNewPlace="updateFilialPlaces"
    />
  </div>
</template>

<script>
import api from "@/lib/api";
import { useStore } from "vuex";
import { provide, ref, toRaw } from "vue";

import HotEdit from "@/components/HotEdit.vue";
import CompanyFilial from "@/components/CompanyFilial.vue";
// import CompanyFilial from '@/components/CompanyFilialFun.vue'

export default {
  components: { HotEdit, CompanyFilial },

  setup() {
    const store = useStore();
    const company = store.getters["auth/company"];

    const filials = ref([]);
    api.trans("filials").then((resp) => {
      if (resp.status === "success") {
        filials.value = resp.data;
      }
    });
    provide('filials',filials)
    
    return {
      test() {
        const r = (filials.value = toRaw(filials.value));
        r[0].name += "1";
        filials.value = r;
      },
      test1() {
        filials.value[0].name += "1";
      },
      company,
      filials,
      deleteFilial(filial) {
        api
          .trans("filials/delete", {
            filial_id: filial.id,
          })
          .then((resp) => {
            if (resp.status === "success") {
              filials.value = toRaw(filials.value).filter(
                (item) => item.id != filial.id
              );
            }
          });
      },
      companyName(data) {
        console.log("[Company] companyName data =", data);
      },
      addNewFilial() {
        let newFilial = api
          .trans("filials/create", {
            company_id: company.id,
          })
          .then((resp) => {
            if (resp.status === "success") {
              filials.value.unshift(resp.data);
            }
          });
      },
      updateFilialPlaces(place) {
        filials.value.map(function (filial) {
          if (filial.id == place.filial_id) {
            if (filial.places) {
              filial.places.unshift(place);
            } else {
              filial.places = [place];
            }
          }
          return filial;
        });
        console.log(filials.value);
      },
    };
  },
};
</script>
