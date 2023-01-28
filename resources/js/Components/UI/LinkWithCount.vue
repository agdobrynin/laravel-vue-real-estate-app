<template>
  <Link
    :href="href"
    class="block w-full button-outline text-xs font-medium text-center relative"
  >
    <span class="absolute w-1 h-1 top-1 rounded-full flex justify-center items-center text-center p-3 bg-gray-200 dark:bg-gray-700 font-light">
      {{ countValue }}
    </span>
    <div class="ml-5">{{ title }}</div>
  </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    href: { type: String, required: true },
    countValue: { type: Number, required: true },
    title: { type: String, required: true },
})
</script>
