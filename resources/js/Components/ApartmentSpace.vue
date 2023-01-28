<template>
  <div>
    <span v-if="showIcons">🛌</span> <span class="font-bold">{{ beds }}</span> beds
    <Delimiter class="ml-2" />
    <span v-if="showIcons">🛀</span> <span class="font-bold">{{ baths }}</span> baths
    <Delimiter class="ml-2" />
    <span v-if="showIcons">🟦</span> <span class="font-bold">{{ area }}</span> m&nbsp;<sup>2</sup>
  </div>
</template>

<script setup>
import Delimiter from '@/Components/UI/Delimiter.vue'

defineProps({
    beds: { type: Number, required: true },
    baths: { type: Number, required: true },
    area: { type: Number, required: true },
    showIcons: { type: Boolean, default: () => true },
})
</script>
