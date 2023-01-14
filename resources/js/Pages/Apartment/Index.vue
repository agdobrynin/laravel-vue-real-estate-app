<template>
  <div v-for="item in list" :key="item.id" class="apartment-item">
    <Link :href="route('apartment.show', {apartment: item.id})">
      <ApartmentAddressWithPrice
        :street="item.street"
        :street_nr="item.street_nr"
        :city="item.city"
        :price="item.price"
      />
    </Link>
    <br />
    <Link :href="route('apartment.edit', {apartment: item.id})">Edit</Link>
    |
    <Link :href="route('apartment.destroy', {apartment: item.id})" method="DELETE" class="del-item" as="button">Delete</Link>
  </div>
</template>

<script setup>
import {Link} from '@inertiajs/inertia-vue3'
import ApartmentAddressWithPrice from '@/Components/ApartmentAddressWithPrice.vue'

defineProps({
    list: Array,
})
</script>

<style scoped>
.apartment-item {
    margin: 1rem 0;
}
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
