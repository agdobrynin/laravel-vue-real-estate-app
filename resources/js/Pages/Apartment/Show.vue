<template>
  <div>
    <ApartmentAddressWithPrice
      :price="apartment.price"
      :city="apartment.city"
      :street_nr="apartment.street_nr"
      :street="apartment.street"
    />
    <hr />
    <Link :href="route('apartment.edit', {apartment: apartment.id})">Edit</Link>
  </div>
</template>

<script setup>
import ApartmentAddressWithPrice from '@/Components/ApartmentAddressWithPrice.vue'
import {Link} from '@inertiajs/inertia-vue3'

defineProps({apartment: Object})
</script>
