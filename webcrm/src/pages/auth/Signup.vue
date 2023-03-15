<template>
  <q-page class="bg-grey-1 window-height window-width row justify-center items-center">
    <div class="column">
      <div class="row">
        <q-card square bordered class="q-pa-lg">
          <q-card-section>
            <user-form :init="form" :config="config" @respone="singUpRespone" />
          </q-card-section>
          <q-card-section class="text-center q-pa-none">
            <p class="text-grey-6">
              Уже зарегистрированы?<br /><router-link :to="{name: 'Sign In'}">Войти в Аккаунт</router-link>
            </p>
          </q-card-section>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script>
import UserForm from '@/components/UserForm.vue'
export default {
  components: { UserForm },
  props: ['roles'],
  name: 'sign-up',
  data () {
    return {
      form: {
        firstname: 'Owner',// + (new Date).getTime(),
        middlename: 'M', // + (new Date).getTime(),
        lastname: 'L', // + (new Date).getTime(),
        phone: '123',
        email: 'mail@owner.com',
        password: '123456',
        roles: this.roles
      },
      config: {
        submitText: 'Регистрация'
      }
    }
  },
  methods: {
    singUpRespone (respone) {
      console.log('[Signup] singUpRespone', respone)
      if (respone.status == 'success') {
        // this.$router.push({name: 'Home'})
      }
    }
  }
}
</script>

<style scoped>
.q-card {
  width: 360px;
}
</style>