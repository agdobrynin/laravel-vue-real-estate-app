<template>
  <div v-if="list.last_page > 1" class="w-full flex justify-center mt-8 mb-8">
    <Pagination :links="list.links" />
  </div>
  <div><FormApartmentFilter :filters="filters" /></div>
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <ApartmentItem v-for="item in list.data" :key="item.id" :item="item" />
  </div>
  <div v-if="list.last_page > 1" class="w-full flex justify-center mt-8 mb-8">
    <Pagination :links="list.links" />
  </div>
</template>

<script setup>
import ApartmentItem from '@/Pages/Apartment/Index/Components/ApartmentItem.vue'
import Pagination from '@/Components/UI/Pagination.vue'
import FormApartmentFilter from '@/Pages/Apartment/Components/FormApartmentFilter.vue'

defineProps({
    list: Object,
    filters: Object,
})
</script>
