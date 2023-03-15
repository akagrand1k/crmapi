<style scoped>
  .filial {
    margin-top: 25px;
  }

  .place {
    padding: 3px 10px 3px 0;
  }
</style>

<template>
  <q-card class="filial" v-for="filial in filials" :key="filial.id">
    <q-card-section class="bg-grey-4 text-black">
      <div class="row items-center no-wrap">
        <div class="col">
          <div class="text-h6">
            <hot-edit :data="filial" field="name" @save="filialPatch" />
          </div>
        </div>
        <div class="col-auto">
          <q-btn color="black" @click="filialDelete(filial)" flat icon="remove_circle_outline" />
        </div>
      </div>
    </q-card-section>
    <q-card-section class="bg-light place text-black">
      <div class="row items-center no-wrap">
        <div class="col">
          <div class="text-h6"></div>
        </div>
        <div class="col-auto">
          <q-btn color="black" label="Кабинет" @click="addNewPlace(filial)" flat icon="add_circle_outline" />
        </div>
      </div>
      <div class="row">
        <div class="col">
          <company-filial-place :places="filial.places" />
        </div>
      </div>
    </q-card-section>

    <!-- <company-filial-place /> -->
  </q-card>
</template>


<script>
  import bbApi from "@/lib/api";
  import HotEdit from "@/components/HotEdit.vue";
  import CompanyFilialPlace from "@/components/CompanyFilialPlace.vue";

  export default {
    components: {
      HotEdit,
      CompanyFilialPlace
    },

    props: ["filials", 'company'],
    setup(props) {
      return {
        async filialPatch(patch) {
          console.log('filial changed')
          const resp = await bbApi.trans("filials/patch", patch);
          if (resp.status === "success") {}
        },
        filialDelete(filial) {
          bbApi.trans("filials/delete", {
            filial_id: filial.id
          }).then((resp) => {
            if (resp.status === "success") {
              bbApi.trans('filials', {
                company_id: props.company.id
              }).then((resp) => {
                if (resp.status === 'success') {
                  props.filials.value = resp.data;
                  console.log('filials=', props.filials)
                }
              })
            }
          })

        },
        addNewPlace(filial) {
          let newFilial = bbApi.trans('places/create', {
            filial_id: filial.id
          }).then((resp) => {
            if (resp.status === 'success') {
              filials.value.push(resp.data);
            }
          });

          // filials.push(newFilial)
        }

      };
    },
  };
</script>