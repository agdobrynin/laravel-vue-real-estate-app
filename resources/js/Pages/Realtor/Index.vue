<template>
  <h1 class="text-3xl mb-4">Your apartments</h1>
  <section class="mb-4">
    <realtor-apartment-filter :filters="filters" />
  </section>
  <div v-if="list.last_page > 1" class="w-full flex justify-center mt-8 mb-8">
    <pagination :links="list.links" />
  </div>
  <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <box v-for="item in list.data" :key="item.id" :class="setBorder(item)">
      <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
        <div :class="setBorderOpacity(item)">
          <div
            v-if="item.sold_at"
            class="text-green-600 dark:text-green-200 text-center border border-green-700 border-dashed px-1 py-1 rounded-xl uppercase"
          >
            sold
          </div>
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
          <div class="mt-2 flex flex-col gap-2">
            <link-with-count
              title="Upload images"
              :count-value="item.images_count"
              :href="route('realtor.apartment.image.create', { apartment: item.id })"
            />
            <link-with-count
              title="Offers"
              :count-value="item.offers_count"
              :href="route('realtor.apartment.show', { apartment: item.id })"
            />
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
import { Link } from '@inertiajs/vue3'
import RealtorApartmentFilter from '@/Pages/Realtor/Index/Componets/RealtorApartmentFilter.vue'
import Pagination from '@/Components/UI/Pagination.vue'
import LinkWithCount from '@/Components/UI/LinkWithCount.vue'

defineProps({ list: Object, filters: Object })

const setBorderOpacity = (apartment) => apartment.deleted_at ? 'opacity-40 dark:opacity-30' : ''
const setBorder = (apartment) => {
    if (apartment.deleted_at) {
        return 'border-2 border-red-600 dark:border-red-400'
    }

    if (apartment.sold_at) {
        return 'border-2 border-green-600 dark:border-green-400'
    }

    if (apartment.offers_count) {
        return 'border-2 border-orange-300 dark:border-orange-400'
    }

    return ''
}
</script>
