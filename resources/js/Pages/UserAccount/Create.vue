<template>
  <div class="w-1/2 mx-auto">
    <form @submit.prevent="doCreate">
      <div>
        <input-with-label
          v-model="form.email"
          label="Email (username)"
          :error="form.errors.email"
        />
      </div>
      <div class="mt-4">
        <input-with-label
          v-model="form.name"
          :error="form.errors.name"
          label="Your name"
        />
      </div>
      <div class="mt-4">
        <input-with-label
          v-model="form.password"
          :error="form.errors.password"
          label="Password"
          field-type="password"
        />
      </div>
      <div class="mt-4">
        <input-with-label
          v-model="form.password_confirmation"
          label="Confirmation password"
          field-type="password"
        />
      </div>
      <div class="mt-8">
        <button type="submit" class="button-primary w-full">Create</button>
        <div class="mt-4 text-center text-gray-400 dark:text-gray-600">
          <Link :href="route('login')" class="underline underline-offset-4">Login with exist account here</Link>
        </div>
      </div>
    </form>
  </div>
</template>

<script setup>

import { Link, useForm } from '@inertiajs/vue3'
import InputWithLabel from '@/Components/UI/InputWithLabel.vue'

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
})

const doCreate = () => form.post(route('user-account.store'))
</script>
