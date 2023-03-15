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
          <q-btn color="black" label="Кабинет" @click="addNewPlace" flat icon="add_circle_outline" />
          <q-btn color="black" round flat icon="more_vert">
              <q-menu  anchor="bottom end" self="top end">
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

    <q-card-section class="bg-light place text-black">   
      <!-- <company-filial-place :places="filial.places" /> -->
    </q-card-section>
  </q-card>
</template>


<script>
  import bbApi from "@/lib/api";
  import HotEdit from "@/components/HotEdit.vue";
  import CompanyFilialPlace from "@/components/CompanyFilialPlaceFun.vue";

  export default {
    components: {
      HotEdit,
      CompanyFilialPlace
    },

    props: ['filial'],
    emits: ['delete'],
    setup(props) {

      return {
        filialPatch(patch) {
          console.log('filial changed')
          bbApi.trans("filials/patch", patch).then((resp)=>{

          })
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

<style scoped>
  .filial {margin-top: 25px;}
  .place {padding: 3px 10px 3px 0;}
</style>

