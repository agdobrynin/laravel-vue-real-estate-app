<template>
  <ApartmentAddressWithPrice
    :price="apartment.price"
    :city="apartment.city"
    :street_nr="apartment.street_nr"
    :street="apartment.street"
  />
</template>

<script setup>
import ApartmentAddressWithPrice from '@/Components/ApartmentAddressWithPrice.vue'

defineProps({apartment: Object})
</script>
