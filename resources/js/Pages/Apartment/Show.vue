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
        <Price :price="apartment.price" class="text-2xl font-bold" />
        <ApartmentSpace :area="apartment.area" :baths="apartment.baths" :beds="apartment.beds" class="text-lg" />
        <ApartmentAddress
          :street="apartment.street"
          :street_nr="apartment.street_nr"
          :city="apartment.city"
          :price="apartment.price"
          :code="apartment.code"
          class="text-gray-500"
        />
      </Box>
      <Box>
        <template #header>Offer</template>
        Make an offer
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

defineProps({apartment: Object})
</script>
