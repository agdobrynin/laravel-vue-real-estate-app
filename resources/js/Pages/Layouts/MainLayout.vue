<template>
  <header class="border-b border-gray-200 bg-gray-100 dark:border-gray-700 dark:bg-gray-800 w-full">
    <div class="container mx-auto">
      <nav class="p-4 flex items-center justify-between">
        <div class="text-lg font-medium">
          <Link :href="route('apartment.index')">Show apartments</Link>
        </div>
        <div class="text-xl font-bold text-center text-indigo-600 dark:text-indigo-300">
          <Link :href="route('index')">Larazilla</Link>
        </div>
        <div v-if="user" class="flex items-center gap-4">
          <Link
            class="text-sm text-gray-500 underline underline-offset-4"
            :href="route('realtor.apartment.index')"
          >
            {{ user.name }}
          </Link>
          <Link
            :href="route('realtor.apartment.create')"
            class="button-primary"
          >
            ➕ Create
            apartment
          </Link>
          <div>
            <Link :href="route('logout')" method="delete" as="button" class="underline underline-offset-4">Logout</Link>
          </div>
        </div>
        <div v-else class="flex items-center gap-4">
          <Link :href="route('user-account.create')" class="underline underline-offset-4">Register</Link>
          <Link :href="route('login')" class="underline underline-offset-4">Login</Link>
        </div>
      </nav>
    </div>
  </header>
  <main class="container mx-auto p-4 w-full">
    <div
      v-if="flashSuccess"
      class="mb-4 border rounded-md p-4 shadow-md border-green-400 dark:border-green-800 bg-green-100 dark:bg-green-900 dark:border-green-500"
    >
      {{ flashSuccess }}
    </div>
    <slot />
  </main>
</template>

<script setup>
import { Link, usePage } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'

const page = usePage()

const flashSuccess = computed(() => page.props.value.flash.success)
const user = computed(() => page.props.value.user)
</script>
