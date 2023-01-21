<template>
  <div v-if="list.data.length" class="w-full flex justify-center mt-8 mb-8">
    <Pagination :links="list.links" />
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <ApartmentItem v-for="item in list.data" :key="item.id" :item="item" />
  </div>
  <div v-if="list.data.length" class="w-full flex justify-center mt-8 mb-8">
    <Pagination :links="list.links" />
  </div>
</template>

<script setup>
import ApartmentItem from '@/Pages/Apartment/Index/Components/ApartmentItem.vue'
import Pagination from '@/Components/UI/Pagination.vue'

defineProps({
    list: Object,
})
</script>
