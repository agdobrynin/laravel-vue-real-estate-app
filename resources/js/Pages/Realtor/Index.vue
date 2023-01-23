<template>
  <h1 class="text-3xl mb-4">Your apartments</h1>
  <section class="mb-4">
    <realtor-apartment-filter :filters="filters" />
  </section>
  <div v-if="list.last_page > 1" class="w-full flex justify-center mt-8 mb-8">
    <pagination :links="list.links" />
  </div>
  <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <box v-for="item in list.data" :key="item.id">
      <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
        <div>
          <price
            :price="item.price"
            class="text-2xl mb-2 block"
          />
          <apartment-space
            :area="item.area"
            :baths="item.baths"
            :beds="item.beds"
            class="mb-2"
          />
          <apartment-address
            :city="item.city"
            :street_nr="item.street_nr"
            :street="item.street"
            :code="item.code"
          />
        </div>
        <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
          <Link class="button-outline text-xs font-medium">Preview</Link>
          <Link class="button-outline text-xs font-medium">Edit</Link>
          <Link
            class="button-outline text-xs font-medium" as="button" method="delete"
            :href="route('realtor.apartment.destroy', {apartment: item.id})"
          >
            Delete
          </Link>
        </div>
      </div>
    </box>
  </section>
  <div v-if="list.last_page > 1" class="w-full flex justify-center mt-8 mb-8">
    <pagination :links="list.links" />
  </div>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import Price from '@/Components/Price.vue'
import ApartmentSpace from '@/Components/ApartmentSpace.vue'
import ApartmentAddress from '@/Components/ApartmentAddress.vue'
import {Link} from '@inertiajs/inertia-vue3'
import RealtorApartmentFilter from '@/Pages/Realtor/Index/Componets/RealtorApartmentFilter.vue'
import Pagination from '@/Components/UI/Pagination.vue'

defineProps({ list: Object, filters: Object })
</script>
