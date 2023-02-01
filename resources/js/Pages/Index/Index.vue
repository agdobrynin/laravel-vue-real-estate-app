<template>
  <h1 class="mb-4"> {{ message }}</h1>
  <p v-if="user">
    Yours apartment list
    <Link
      :href="route('realtor.apartment.index')"
      class="as-href"
    >
      here
    </Link>.
  </p>
  <p v-else>
    To conduct real estate purchase and sale transactions, you must
    <Link :href="route('user-account.create')" class="as-href">register</Link> on our service
    or login with exist account <Link :href="route('login')" class="as-href">here</Link>
  </p>
</template>

<script setup>
import { computed } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'

defineProps({
    message: { type: String, default: 'I am default value' },
})

const user = computed(() => usePage().props.user)
</script>
