<template>
  <header class="border-b border-gray-200 bg-gray-100 dark:border-gray-700 dark:bg-gray-800 w-full">
    <div class="container mx-auto">
      <nav class="p-4 flex items-center justify-between">
        <div class="text-lg font-medium">
          <Link :href="route('apartment.index')">Offer list</Link>
        </div>
        <div class="text-xl font-bold text-center text-indigo-600 dark:text-indigo-300">
          <Link :href="route('index')">Real estate agency</Link>
        </div>
        <div v-if="user" class="flex items-center gap-4">
          <Link
            :href="route('notification.index')"
            class="flex justify-between relative text-gray-500 pr-2 py-2 text-lg"
          >
            <div class="w-7">🔔</div>
            <div
              v-if="notificationCounf"
              class="absolute right-0 pl-0.5 overflow-hidden mt-1 pt-0.5 top-0 w-6 h-6 bg-red-700 dark:bg-red-400 text-white font-medium border border-white dark:border-gray-900 rounded-full text-xs text-center"
            >
              {{ notificationCounf }}
            </div>
          </Link>
          <Link
            class="text-indigo-700 underline underline-offset-4 dark:text-indigo-400"
            :href="route('realtor.apartment.index')"
          >
            {{ user.name }}
          </Link>
          <Link
            :href="route('realtor.apartment.create')"
            class="underline underline-offset-4 text-red-700 dark:text-red-500"
          >
            Add apartment
          </Link>
          <div>
            <Link
              :href="route('logout')"
              method="delete"
              as="button"
              class="underline underline-offset-4"
            >
              Logout
            </Link>
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
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const flashSuccess = computed(() => usePage().props.flash.success)
const user = computed(() => usePage().props.user)
const notificationCounf = computed(() => Math.min(usePage().props.user.notificationCount, 9))
</script>
