<template>
  <q-form class="q-gutter-sx" @submit="onSubmit">
    <role-select :iroles="form.roles" />
    <q-input 
       type="text" label="Имя" 
      v-model="form.firstname"
      lazy-rules :rules="[val => val && val.length > 0 || 'Введите Имя']" 
    />
    <q-input
      type="text" label="Отчество"
      v-model="form.middlename"
      lazy-rules :rules="[val => val && val.length > 0 || 'Введите Отчество']" 
    />
    <q-input
      type="text" label="Фамилия"
      v-model="form.lastname"
      lazy-rules :rules="[val => val && val.length > 0 || 'Введите Фамилию']" 
    />

    <q-input 
      v-model="form.birthday" label="Дата рождения" 
      mask="date" :rules="['date']" 
    >
      <template v-slot:append>
        <q-icon name="event" class="cursor-pointer">
          <q-popup-proxy transition-show="scale" transition-hide="scale">
            <q-date v-model="form.birthday" mask="YYYY-MM-DD" minimal>
              <div class="row items-center justify-end">
                <q-btn v-close-popup label="Закрыть" color="primary" flat />
              </div>
            </q-date>
          </q-popup-proxy>
        </q-icon>
      </template>
    </q-input>

    <div class="row">
      <div class="col col-md-auto">
        Пол
      </div>
      <div class="col">
        <q-option-group
          v-model="form.gender"
          :options="[
            {label: 'Мужской', value: 'мужской'},
            {label: 'Женский', value: 'женский'},
          ]"
          color="primary" inline
        />
      </div>
    </div>

    <!--  -->
    <q-input 
      clearable type="tel" label="Телефон"
      v-model="form.phone"
      lazy-rules :rules="[val => val && (val.length > 0 || val >0) || 'Введите Телефон']" 
    />
    <q-input 
      clearable type="email" label="E-mail"
      v-model="form.email"
      lazy-rules :rules="[val => val && val.length > 0 || 'Введите E-mail']" 
    />

    <q-input
      v-model="form.password" 
      label="Пароль" 
      :type="isPwd ? 'password' : 'text'"
      lazy-rules
      :rules="[
        v => !!v || 'Введите Пароль',
        v => (v && v.length >= 6) || 'Минимальная длина 6 символов'
      ]" 
    >
      <template v-slot:append>
        <q-icon
          :name="isPwd ? 'visibility_off' : 'visibility'"
          class="cursor-pointer"
          @click="isPwd = !isPwd"
        />
      </template>
    </q-input>

    <q-btn type="submit" :label="cnf.submitText" color="primary" />
    <!--<q-btn label="Сбросить" color="primary" @click="reset" />
     <q-btn label="Test" color="light-blue-7" @click="butTest" /> -->
  </q-form>
</template>

<script>
import { computed, inject, reactive, ref, toRaw, toRefs, unref, watch } from 'vue'
import { useStore } from 'vuex'
import RoleSelect from '@/components/RoleSelect.vue'
export default {

  components: { RoleSelect },
  props: ['init', 'config', 'test'],
  emits:['respone'],

  setup(props, { emit }) 
  {
    const loader = inject('bbLoader')
    const store = useStore()

    const formRef = ref ({
      firstname: '',
      middlename: '',
      lastname: '',
      gender: 'none',
      birthday: '0000-00-00',
      phone: '',
      email: '',
      password: '',
      roles:[],
      ...props.init
    })
    const formRea = reactive ({
      firstname: '',
      middlename: '',
      lastname: '',
      gender: 'none',
      birthday: '0000-00-00',
      phone: '',
      email: '',
      password: '',
      roles:[],
      ...props.init
    })

    const cnf = {
      init: 'user/fake',
      //dispacth: 'auth/signUp',
      submitText: 'Отправить',
      ...props.config
    }

    const state = reactive({
      form: {
        firstname: '',
        middlename: '',
        lastname: '',
        gender: 'none',
        birthday: '0000-00-00',
        phone: '',
        email: '',
        password: '',
        roles:[],
        ...props.init
      },
      cnf: {
        init: 'user/fake',
        //dispacth: 'auth/signUp',
        submitText: 'Отправить',
        ...props.config
      }
    })

    function fake() {
      if( cnf.init ){
        store.dispatch(cnf.init).then((resp) => {
          //console.log('Fake User: ', resp)
          if( resp.status == 'success' ){
            //console.log('props =', props.test)
            state.form = {...toRaw(state.form), ...props.init, ...resp.data}
            //console.log('Fake state.form = ', state.form)
          } 
        })
      }
    }
    fake()

    //propsInit
    

    return {
      //form: state.form, cnf.cnf,
      ...toRefs(state),
      isPwd: ref(true),

      reset() {
        state.form = {...toRaw(state.form), ...toRaw(props.init)}
      },
      butTest () {
        //console.log('this.form.role =', this.form.role)
        emit('respone',{status: 'success'})
      },
      onSubmit () {

        //console.log('state.form = ', state.form)
        //console.log('...toRefs(state) = ', {...toRefs(state)})

        // 1. is OK
        //console.log('toRaw(formRea) = ', toRaw(formRea))

        // 2. object with 'ref' propeties 
        //console.log('toRefs(formRea) = ', toRefs(formRea))
        // 3. nested 'roles' is 'Proxy'
        //console.log('{...formRea} = ', {...formRea})

        // 1. is OK
        //console.log('toRaw(formRef.value) = ', toRaw(formRef.value))

        // 2. is 'Proxy'
        //console.log('unref(formRef) = ', unref(formRef))
        // 3. is 'Proxy'
        //console.log('unref(formRef.value) = ', unref(formRef.value))
        // 4. is { __v_isRef: true, ... } 
        //console.log('{...formRef} = ', {...formRef})
        // 5. nested 'roles' is 'Proxy'
        //console.log('{...formRef.value} = ', {...formRef.value})
   
        emit('respone', toRaw(state.form))
        fake()/*
        loader.show({message: `${cnf.submitText}...`})
        // console.log('request =', {...this.form})
        store.dispatch(cnf.dispacth, {...form}).then((respone) => {
          emit('respone', respone)
          loader.hide() 
        })*/
      }
    }
  }
}
</script>
