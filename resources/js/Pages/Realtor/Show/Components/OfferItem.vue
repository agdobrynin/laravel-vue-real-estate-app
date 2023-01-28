<template>
  <box class="mb-4">
    <template #header>
      Offer # {{ offer.id }}
      <span
        v-if="offer.accepted_at"
        class="text-green-200 bg-green-700 px-2 py-1 rounded-xl uppercase"
      >accepted</span>
      <span
        v-else-if="offer.rejected_at"
        class="text-red-200 bg-red-700 px-2 py-1 rounded-xl uppercase"
      >rejected</span>
    </template>
    <div class="flex items-center justify-between">
      <div>
        <price :price="offer.amount" class="text-2xl" />
        <div class="text-gray-500">
          Difference <price :price="difference" :class="[difference >= 0 ? 'text-green-600' : 'text-red-600']" />
        </div>
        <div class="text-sm text-gray-500">
          Made by <span class="font-medium">{{ offer.offered_by_user.name }}</span>
        </div>
        <div class="text-sm text-gray-500">
          Made on <span class="font-medium">{{ offerDate }}</span>
        </div>
      </div>
      <div>
        <Link
          v-if="!isSold"
          :href="route('realtor.accept.offer', {offer: offer.id})"
          class="button-outline text-sm font-medium"
          as="button"
          method="put"
        >
          Accept
        </Link>
      </div>
    </div>
  </box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import { Link } from '@inertiajs/vue3'
import Price from '@/Components/Price.vue'
import { computed } from 'vue'

const props = defineProps({
    offer: { type: Object, required: true },
    apartmentPrice: { type: Number, required: true },
    isSold: { type: Boolean, required: true },
})

const difference = computed(() => props.offer.amount - props.apartmentPrice)
const offerDate = computed(() => (new Date(props.offer.created_at)).toLocaleDateString())
</script>

