<template>
  <div>
    <ApartmentAddress
      :price="apartment.price"
      :city="apartment.city"
      :street_nr="apartment.street_nr"
      :street="apartment.street"
      :code="apartment.code"/>
    <hr />
    <Link :href="route('apartment.edit', {apartment: apartment.id})">Edit</Link>
  </div>
</template>

<script setup>
import ApartmentAddress from '@/Components/ApartmentAddress.vue'
import {Link} from '@inertiajs/inertia-vue3'

defineProps({apartment: Object})
</script>
