<template>
  <div class="text-center">
    <p class="text-2xl">You mast verify your email address.</p>
    <Link
      :href="route('verification.send')"
      method="post"
      as="button"
      class="underline underline-offset-4 text-gray-400 dark:text-gray-500 mt-4"
    >
      Resend email with conformation link
    </Link>
  </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3'
</script>
