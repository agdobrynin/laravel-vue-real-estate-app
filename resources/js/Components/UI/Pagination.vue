<template>
  <div class="flex gap-2">
    <Link
      v-for="(link, id) in links"
      :key="id"
      :href="link.url"
      class="rounded-md border py-2 px-4"
      :class="{'bg-indigo-600 text-gray-300 dark:bg-indigo-800': link.active}"
      v-html="link.label"
    />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'

defineProps({ links: { type: Array, required: true } })
</script>
