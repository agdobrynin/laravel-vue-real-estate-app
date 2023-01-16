<template>
  <Box>
    <Link :href="route('apartment.show', {apartment: item.id})">
      <div class="flex items-center gap-2 mb-4">
        <Price :price="item.price" class="text-3xl font-bold" />
        <div class="text-gray-900 dark:text-gray-400 text-xs">
          <Price :price="monthlyPayment" class="block font-light">Per&nbsp;month</Price>
          <Price :price="totalPaid" class="block font-light">Total price</Price>
          <Price :price="totalInterest" class="block font-light">Total interest</Price>
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
    <br />
    <Link :href="route('apartment.edit', {apartment: item.id})">Edit</Link>
    |
    <Link :href="route('apartment.destroy', {apartment: item.id})" method="DELETE" class="del-item" as="button">
      Delete
    </Link>
  </Box>
</template>

<script setup>
import ApartmentSpace from '@/Components/ApartmentSpace.vue'
import ApartmentAddress from '@/Components/ApartmentAddress.vue'
import Price from '@/Components/Price.vue'
import {Link} from '@inertiajs/inertia-vue3'
import Box from '@/Components/UI/Box.vue'
import {useMonthlyPayment} from '@/Composables/useMonthlyPayment'

const props = defineProps({item: {type: Object, required: true}})

const {monthlyPayment, totalPaid, totalInterest} = useMonthlyPayment(props.item.price)
</script>

