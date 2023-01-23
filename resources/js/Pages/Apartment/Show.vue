<template>
  <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
    <Box class="md:col-span-7 flex items-center w-full">
      <div class="w-full text-center font-medium text-gray-500">
        No images
      </div>
    </Box>
    <div class="md:col-span-5 flex flex-col gap-4">
      <Box>
        <template #header>Basic info</template>
        <price
          :price="apartment.price"
          class="block mb-4 text-2xl font-bold"
        >
          Price
        </price>

        <apartment-space
          :area="apartment.area"
          :baths="apartment.baths"
          :beds="apartment.beds"
          class="text-lg"
        />
        <apartment-address
          :street="apartment.street"
          :street_nr="apartment.street_nr"
          :city="apartment.city"
          :price="apartment.price"
          :code="apartment.code"
          class="text-gray-500"
        />
      </Box>
      <Box>
        <template #header>Monthly payment</template>
        <div>
          <label class="label">Interest range ({{ interestRate }} %)</label>
          <input
            v-model.number="interestRate"
            type="range" min="0.1" :max="maxInterestRate" step="0.1"
            class="w-full appearance-none h-4 bg-gray-200 rounded-lg cursor-pointer dark:bg-gray-700"
          />
        </div>
        <div>
          <label class="label">Duration ( {{ duration }} years)</label>
          <input
            v-model.number="duration"
            type="range" min="3" :max="maxDuration" step="1"
            class="w-full appearance-none h-4 bg-gray-200 rounded-lg cursor-pointer dark:bg-gray-700"
          />
        </div>
        <div class="text-gray-600 dark:text-gray-300 mt-2">
          <div class="text-gray-400">Your monthly payment</div>
          <price
            :price="monthlyPayment"
            class="text-3xl"
          />
          <price
            :price="totalPaid"
            class="font-bold block mt-3 font-medium"
          >
            Total paid:
          </price>
          <price
            :price="totalInterest"
            class="font-bold block mt-3 font-medium"
          >
            Total interested:
          </price>
        </div>
      </Box>
    </div>
    <Link :href="route('apartment.edit', {apartment: apartment.id})">Edit</Link>
  </div>
</template>

<script setup>
import ApartmentAddress from '@/Components/ApartmentAddress.vue'
import {Link} from '@inertiajs/inertia-vue3'
import Price from '@/Components/Price.vue'
import ApartmentSpace from '@/Components/ApartmentSpace.vue'
import Box from '@/Components/UI/Box.vue'
import {ref} from 'vue'
import {
    defaultDuration,
    defaultInterestRate,
    maxDuration,
    maxInterestRate,
    useMonthlyPayment,
} from '@/Composables/useMonthlyPayment'

const props = defineProps({apartment: Object})

const interestRate = ref(defaultInterestRate)
const duration = ref(defaultDuration)

const {monthlyPayment, totalPaid, totalInterest} = useMonthlyPayment(props.apartment.price, interestRate, duration)
</script>
