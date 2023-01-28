<template>
  <box>
    <template #header>Make offer</template>
    <form @submit.prevent="makeOffer">
      <input-with-label
        v-model.number="form.amount"
        label="Amount"
        :error="form.errors.amount"
        :maska-options="MASK_PRICE"
      />
      <input
        v-model.number="form.amount"
        type="range"
        :min="minPrice"
        :max="maxPrice"
        step="10000"
        class="w-full mt-4 mb-4 appearance-none h-4 bg-gray-200 rounded-lg cursor-pointer dark:bg-gray-700"
      />
      <button type="submit" class="text-sm w-full button-outline dark:button-normal">Make offer</button>
    </form>
    <div class="flex justify-between text-gray-500 mt-4">
      <div>Difference</div>
      <price :price="difference" class="font-bold" />
    </div>
  </box>
</template>

<script setup>
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { computed, watch } from 'vue'
import InputWithLabel from '@/Components/UI/InputWithLabel.vue'
import { useForm } from '@inertiajs/vue3'
import { MASK_PRICE } from '@/Utils/mask'
import { debounce } from 'lodash'

const props = defineProps({
    price: { type: Number, required: true },
    apartmentId: { type: Number, required: true },
})

const minPrice = computed(() => Math.round(props.price / 2))
const maxPrice = computed(() => Math.round(props.price * 2))
const difference = computed(() => form.amount - props.price)

const form = useForm({
    amount: props.price,
})

const makeOffer = () => form.post(
    route('apartment.offer.store', { apartment: props.apartmentId }),
    { preserveScroll: true, preserveState: true },
)

const emit = defineEmits(['offerPriceUpdate'])

watch(
    () => form.amount,
    debounce((price) => emit('offerPriceUpdate', price), 200),
)
</script>
