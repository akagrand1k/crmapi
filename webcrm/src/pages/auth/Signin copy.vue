<template>
  <q-page
    class="bg-grey-1 window-height window-width row justify-center items-center"
  >
    <div class="column">
      <div class="row">
        <q-card square bordered class="q-pa-lg">
          <q-card-section v-if="identities.length">
            <strong>Выберите Роль</strong>

            <q-list bordered>
              <q-item
                v-for="(identity, index) of identities"
                :key="identity.id"
                :data-identity="index"
                @click="setIdentity"
                clickable
                v-ripple
              >
                <q-item-section>
                  <q-item-label>{{ identity.role.caption }}</q-item-label>
                  <q-item-label caption lines="1">{{
                    identity.company.caption
                  }}</q-item-label>
                </q-item-section>
              </q-item>
            </q-list>
          </q-card-section>

          <q-card-section v-else>
            <q-form class="q-gutter-md" @submit="onSubmit">
              <q-input
                square
                filled
                clearable
                type="tel"
                label="Телефон"
                v-model="phone"
                lazy-rules
                :rules="[(val) => (val && val.length > 0) || 'Введите Телефон']"
              />

              <q-input
                square
                filled
                v-model="password"
                label="Пароль"
                :type="isPwd ? 'password' : 'text'"
                lazy-rules
                :rules="[
                  (v) => !!v || 'Введите Пароль',
                  (v) => (v && v.length >= 6) || 'Минимальная длина 6 символов',
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

              <q-btn type="submit" label="Войти" color="light-blue-7" />
              <!--
              <p class="text-grey-6">
                У Вас нет Аккаунта? <router-link :to="{name: 'Sign Up Owner'}">Создать Аккаунт</router-link>
              </p>-->
            </q-form>
          </q-card-section>
<!--
          <q-card-section class="text-center q-pa-none">
            <router-link :to="{name: 'Sign Up Owner'}">Регистрация</router-link>
            <router-link to="/sign-in1">sign-in1</router-link>
          </q-card-section>
          
          <q-card-section class="text-center q-pa-none">
            <q-btn type="submit" label="Test" color="light-blue-7" @click="test" />
          </q-card-section>
-->
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script>
export default {
  name: 'sign-in',

  data: () => ({
    phone: '+79177264331',
    password: '123456',
    isPwd: 'password',

    identities: [],
    user: {},
  }),

  methods: {
    async onSubmit() {
      this.$bb.loading.show({ message: 'Вход в систему...' })

      const respone = await this.$store.dispatch('auth/signIn', {
        phone: this.phone,
        password: this.password,
      })

      if (respone.status === 'success') {
        this.$router.push({ name: 'Home' })
        /*
        if (respone.data.identities.length === 1) {
          respone.data.identities[0].user = respone.data.user
          this.$store.commit('auth/setIdentity', respone.data.identities[0])
          this.$router.push({ name: 'Home' })
        } else {
          this.user = respone.data.user
          this.identities = respone.data.identities
        }*/
      }
      this.$bb.loading.hide()
    },

    setIdentity(event) {
      const index = event.currentTarget.getAttribute('data-identity')
      this.identities[index].user = this.user
      this.$store.commit('auth/setIdentity', this.identities[index])
      this.$router.push({ name: 'Home' })
    },

    test() {},
  },

  mounted() {
    this.$bb.loading.hide()
  },
}
</script>

<style scoped>
.q-card {
  width: 360px;
}
</style>
