<template>
  <div>
    <span class="font-bold">{{ beds }}</span> beds <span v-if="showIcons">🛌</span>
    <Delimiter class="ml-2" />
    <span class="font-bold">{{ baths }}</span> baths <span v-if="showIcons">🛀</span>
    <Delimiter class="ml-2" />
    <span class="font-bold">{{ area }}</span> m&nbsp;<sup>2</sup> <span v-if="showIcons">🏠</span>
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
