<template>
  <h1 class="text-3xl mb-4">Your apartments</h1>
  <section class="mb-4">
    <realtor-apartment-filter :filters="filters" />
  </section>
  <div v-if="list.last_page > 1" class="w-full flex justify-center mt-8 mb-8">
    <pagination :links="list.links" />
  </div>
  <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <box v-for="item in list.data" :key="item.id" :class="{'border-2 border-red-600 dark:border-red-400': item.deleted_at}">
      <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
        <div :class="{'opacity-40 dark:opacity-30': item.deleted_at}">
          <price
            :price="item.price"
            class="text-2xl mb-2 block"
          />
          <apartment-space
            :area="item.area"
            :baths="item.baths"
            :beds="item.beds"
            :show-icons="false"
            class="mb-2"
          />
          <apartment-address
            :city="item.city"
            :street_nr="item.street_nr"
            :street="item.street"
            :code="item.code"
          />
        </div>
        <section>
          <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
            <a
              v-show="!item.deleted_at"
              :href="route('apartment.show', {apartment: item.id})"
              target="_blank"
              class="button-outline text-xs font-medium"
            >Preview</a>
            <Link
              :href="route('realtor.apartment.edit', {apartment: item.id})"
              class="button-outline text-xs font-medium"
            >
              Edit
            </Link>
            <Link
              v-if="!item.deleted_at"
              :href="route('realtor.apartment.destroy', {apartment: item.id})"
              as="button" method="delete"
              class="button-outline text-xs font-medium"
            >
              Delete
            </Link>
            <Link
              v-else
              :href="route('realtor.apartment.restore', {apartment: item.id})"
              as="button" method="put"
              class="button-outline text-xs font-medium"
            >
              Restore
            </Link>
          </div>
          <div class="mt-4">
            <Link
              :href="route('realtor.apartment.image.create', { apartment: item.id })"
              class="block w-full button-outline text-xs font-medium text-center relative"
            >
              <span class="absolute w-1 h-1 top-1 rounded-full flex justify-center items-center text-center p-3 bg-gray-200 dark:bg-gray-700 font-light">
                {{ item.images_count }}
              </span>
              Upload images
            </Link>
          </div>
        </section>
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
import { Link } from '@inertiajs/inertia-vue3'
import RealtorApartmentFilter from '@/Pages/Realtor/Index/Componets/RealtorApartmentFilter.vue'
import Pagination from '@/Components/UI/Pagination.vue'

defineProps({ list: Object, filters: Object })
</script>
