<template>
  <Box>
    <Link :href="route('apartment.show', {apartment: item.id})">
      <div class="flex items-center gap-2 mb-4">
        <Price :price="item.price" class="text-3xl font-bold" />
        <div class="text-gray-900 dark:text-gray-400">
          <Price :price="monthlyPayment" class="block font-light">Per&nbsp;month</Price>
          <div class="font-light text-xs">
            Rate {{ defaultInterestRate }} %, Duration {{ defaultDuration }}
            years
          </div>
        </div>
      </div>
      <ApartmentSpace :area="item.area" :baths="item.baths" :beds="item.beds" class="text-lg" />
      <ApartmentAddress
        :street="item.street"
        :street_nr="item.street_nr"
        :city="item.city"
        :price="item.price"
        :code="item.code"
        class="text-gray-500"
      />
    </Link>
  </Box>
</template>

<script setup>
import ApartmentSpace from '@/Components/ApartmentSpace.vue'
import ApartmentAddress from '@/Components/ApartmentAddress.vue'
import Price from '@/Components/Price.vue'
import { Link } from '@inertiajs/vue3'
import Box from '@/Components/UI/Box.vue'
import { defaultDuration, defaultInterestRate, useMonthlyPayment } from '@/Composables/useMonthlyPayment'

const props = defineProps({ item: { type: Object, required: true } })

const { monthlyPayment } = useMonthlyPayment(props.item.price)
</script>

