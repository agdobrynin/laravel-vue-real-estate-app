<template>
  <div>
    <span class="font-bold">{{ beds }}</span> beds 🛌
    <Delimiter />
    <span class="font-bold">{{ baths }}</span> baths 🛀
    <Delimiter />
    <span class="font-bold">{{ area }}</span> m&nbsp;<sup>2</sup> 🏠
  </div>
</template>

<script setup>
import Delimiter from '@/Components/UI/Delimiter.vue'

defineProps({
    beds: { type: Number, required: true },
    baths: { type: Number, required: true },
    area: { type: Number, required: true },
})
</script>
