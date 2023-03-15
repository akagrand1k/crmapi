<style>
.my-card {
  max-width: 400px;
}
 /* .my-card label.q-field {
  max-width: 400px;
  display: inline-block;
  margin-left: 10px;
 } */
</style>

<template>
  <q-splitter v-model="splitterModel" :limits="[33, 99]" style="height: 100vh" >
    <template v-slot:before>
      <div v-if="!form" class="q-pa-sm">

        <!-- <q-btn round color="primary" icon="person_add" style="font-size:10px;" @click="splitterModel=66" />  -->
        <q-btn round color="primary" icon="person_add" style="font-size:10px;" @click="form=true" /> 

        <strong> Аккаунты</strong>

        <role-select :iroles="cnf.roles" @update="changeRoles" class="q-mt-md" />
        <!-- <role-select v-model="cnf.roles" class="q-mt-md" /> -->

        <q-input borderless dense debounce="300" v-model="cnf.filter" placeholder="Search">
          <template v-slot:append>
            <q-icon name="search" />
          </template>
        </q-input>
        
        <user-table :cnf=cnf @selected="rowSelected" />

      </div>
      <div v-else class="q-pa-sm">
        <q-card class="my-card">

          <q-item>
            <q-item-section>
              <q-item-label class="text-h6">Добавление пользователя</q-item-label>
            </q-item-section>

            <q-item-section avatar>
              <q-avatar>
                <!-- <q-btn round color="primary" icon="close" style="font-size:10px;" @click="splitterModel=99" /> -->
                <q-btn round color="primary" icon="close" style="font-size:10px;" @click="form=false" />
              </q-avatar>
            </q-item-section>
          </q-item>
          <q-separator />
          <q-card-section>
            <user-form :test="Test" @respone="formRespone" />
          </q-card-section>

        </q-card>
      </div>
    </template>
    <template v-slot:after>
      <div class="q-pa-sm">

        <user-roles v-if="splitterModel< 99" />

      </div>
    </template>
  </q-splitter>
</template>

<script>
import { computed, inject, onMounted, ref, watch } from 'vue'
import { useRoute } from 'vue-router'
import { useStore } from 'vuex'
import RoleSelect from '@/components/RoleSelect.vue'
import UserForm from '@/components/UserForm.vue'
import UserRoles from '@/components/UserRoles.vue'
import UserTable from '@/components/UserTable.vue'


export default {
  components: { RoleSelect, UserForm, UserRoles, UserTable },
  // TODO: сделать setup через async + Suspense
  // https://vueschool.io/articles/vuejs-tutorials/suspense-new-feature-in-vue-3/
  // использую quasar innerLoader
  setup() {

    // TODO: bbLoader переделать в appLoader(Перекрывает весь экран) и добавить pageLoader(Перекрывает рабочую область, NavBar открыт)
    const loader = inject('bbLoader')

    const route = useRoute()
    const store = useStore()
    const splitterModel = ref(99)

    const form = ref(false)

    //const cnf = ref({roles:['student'], filter:''})
    const cnf = ref({roles:[], filter:''})

    const init = {/*
      firstname: 'f',
      middlename: 'm',
      lastname: 'l',
      birthday: '',
      phone: '',
      email: '',
      password: '123456',*/
      roles: cnf.roles
    }

    return {
      Test: 'ok',
      cnf,
      //userFormConfig: { dispatch: 'users/create' },
      form,
      init,
      changeRoles (roles) {
        //cnf.value = {...cnf, roles}
        cnf.value.roles = roles
      },
      formRespone (resp) {
        loader.show({message: 'Создание аккаунта...'})
        // console.log('request =', {...this.form})
        store.dispatch('user/create', resp).then((respone) => {
          //emit('respone', respone)
          loader.hide() 
        })
      },
      splitterModel,
      rowSelected(items){
        if(items.length > 0) {
          splitterModel.value = 75
        }
        console.log('[Users] rowSelected =', items)
      }
    }

  }
}
</script>