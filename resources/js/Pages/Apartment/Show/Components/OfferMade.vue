<template>
  <box>
    <template #header>Offer Made</template>

    <price :price="offerMade.amount" class="text-3xl" />

    <section class="mt-2 flex flex-col md:flex-row justify-between text-gray-500">
      <div>Made on</div>
      <div class="font-medium">{{ offerDate }}</div>
    </section>
  </box>
</template>

<script setup>
import { computed } from 'vue'
import Box from '@/Components/UI/Box.vue'
import Price from '@/Components/Price.vue'

const props = defineProps({
    offerMade: Object,
})

const offerDate = computed(() => (new Date(props.offerMade.created_at)).toLocaleDateString())
</script>

