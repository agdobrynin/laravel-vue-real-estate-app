<template>
  <header class="border-b border-gray-200 bg-gray-100 dark:border-gray-700 dark:bg-gray-800 w-full">
    <div class="container mx-auto">
      <nav class="p-4 flex items-center justify-between">
        <div class="text-lg font-medium">
          <Link :href="route('apartment.index')">Show apartments</Link>
        </div>
        <div class="text-xl font-bold text-center text-indigo-600 dark:text-indigo-300">
          <Link :href="route('apartment.index')">Larazilla</Link>
        </div>
        <div>
          <Link
            :href="route('apartment.create')"
            class="button-primary"
          >
            ➕ Create
            apartment
          </Link>
        </div>
      </nav>
    </div>
  </header>
  <main class="container mx-auto p-4">
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
import {Link, usePage} from '@inertiajs/inertia-vue3'
import {computed} from 'vue'

const page = usePage()

const flashSuccess = computed(() => page.props.value.flash.success)
</script>
