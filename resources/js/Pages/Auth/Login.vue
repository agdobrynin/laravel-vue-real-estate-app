<template>
  <div class="w-1/2 mx-auto">
    <form @submit.prevent="doLogin">
      <div>
        <InputWithLabel v-model.trim="form.email" :error="form.errors.email" label="Email (username)" />
      </div>
      <div class="mt-4">
        <InputWithLabel v-model="form.password" :error="form.errors.password" label="Password" field-type="password" />
      </div>
      <div class="mt-8">
        <button type="submit" class="button-primary w-full">Login</button>
        <div class="mt-4 text-center text-gray-400 dark:text-gray-600">
          <Link :href="route('user-account.create')" class="underline underline-offset-4">Register a new user</Link>
        </div>
      </div>
    </form>
  </div>
</template>

<script setup>
import InputWithLabel from '@/Components/UI/InputWithLabel.vue'
import {Link, useForm} from '@inertiajs/inertia-vue3'

const form = useForm({
    email: null,
    password: null,
})

const doLogin = () => form.post(route('login.store'))
</script>
