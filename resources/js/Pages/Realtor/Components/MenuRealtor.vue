<template>
  <box class="mb-4">
    <Link :href="route('realtor.apartment.index')" class="underline underline-offset-4">
      &lAarr; Back to my apartments
    </Link>
  </box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import { Link } from '@inertiajs/vue3'
</script>
