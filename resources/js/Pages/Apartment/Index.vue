<template>
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <ApartmentItem v-for="item in list" :key="item.id" :item="item" />
  </div>
</template>

<script setup>
import ApartmentItem from '@/Pages/Apartment/Index/Components/ApartmentItem.vue'

defineProps({
    list: Array,
})
</script>
