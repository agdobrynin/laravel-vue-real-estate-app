<template>
  <h1 class="text-2xl mb-4">Your notification</h1>
  <section v-if="notifications.data.length">
    <div v-if="notifications.last_page > 1" class="w-full flex justify-center mt-8 mb-8">
      <pagination :links="notifications.links" />
    </div>
    <div
      v-for="notification in notifications.data"
      :key="notification.id"
      class="py-4 flex justify-between items-center border-b border-gray-200"
    >
      <div>
        <span v-if="notification.type === 'App\\Notifications\\OfferMade'">
          Offer <price :price="notification.data.amount" /> for
          <Link
            :href="route('realtor.apartment.show', {apartment: notification.data.apartment_id})"
            class="text-indigo-600 underline underline-offset-4"
          >apartemnt</Link> was made.
        </span>
      </div>
      <div>
        <Link
          v-if="notification.read_at === null"
          :href="route('notification.seen', {notification: notification.id})"
          method="put"
          as="button"
          class="button-outline text-sm"
        >
          mark as read
        </Link>
      </div>
    </div>
  </section>
  <section v-else>
    <box>Notification not found</box>
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import Box from '@/Components/UI/Box.vue'
import Pagination from '@/Components/UI/Pagination.vue'
import Price from '@/Components/Price.vue'

defineProps({
    notifications: Object,
})
</script>
