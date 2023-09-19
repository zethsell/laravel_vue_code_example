<script setup lang="ts">
import CardAuth from '@/components/auth/CardAuth.vue'
import MButton from '@/components/auth/ButtonAuth.vue'
import MInput from "@/components/inputs/MInput.vue"
import {computed, onMounted, ref} from 'vue'
import type {UserRegister} from '@/models'
import {useLoginStore} from '@/stores/login'

const loginStore = useLoginStore()
const loadingReq = ref(false)
const user = ref<UserRegister>({
  email: '',
  password: '',
  name: '',
  password_confirmation: '',
})

onMounted(() => loginStore.loggedUser())

const passVerify = computed(() => user.value.password === user.value.password_confirmation)

async function __register() {
  loadingReq.value = true
  await loginStore.signUpUser(user.value)
  loadingReq.value = false
}

</script>
<template>
  <CardAuth title="Sign Up">
    <form @submit.prevent="(__register())">
      <m-input label="Name" v-model="user.name" required/>
      <m-input label="E-mail" type="email" v-model="user.email" required/>
      <m-input label="Password" type="password" v-model="user.password" required/>
      <m-input label="Confirm Password" type="password" v-model="user.password_confirmation" required/>
      <m-button type="submit" label="Sign Up" :loading="loadingReq"/>
      <span v-if="!passVerify" id="error">The passwords does not match!</span>
    </form>
    <span>Welcome! Start sell Today!</span>
  </CardAuth>
</template>
<style lang="scss" scoped>
form {
  width: 100%;
  padding: 20px;

  span {
    font-size: 12px;
    color: #C70039;
  }
}
</style>