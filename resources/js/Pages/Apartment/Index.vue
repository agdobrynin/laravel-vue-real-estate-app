<template>
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <Box v-for="item in list" :key="item.id">
      <Link :href="route('apartment.show', {apartment: item.id})">
        <Price :price="item.price" class="text-2xl font-bold" />
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
  </div>
</template>

<script setup>
import {Link} from '@inertiajs/inertia-vue3'
import ApartmentAddress from '@/Components/ApartmentAddress.vue'
import Box from '@/Components/UI/Box.vue'
import ApartmentSpace from '@/Components/ApartmentSpace.vue'
import Price from '@/Components/Price.vue'

defineProps({
    list: Array,
})
</script>

<style scoped>
.del-item {
    background: transparent;
    border: none;
    text-decoration: underline 2px;
    color: red;
    cursor: pointer;
    margin: 0;
    padding: 0;
}
</style>
