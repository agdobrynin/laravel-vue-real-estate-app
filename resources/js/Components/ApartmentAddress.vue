<template>
  <span>
    {{ street }} {{ street_nr }} st., city {{ city }}, postal code {{ code }}
  </span>
</template>

<script setup>
defineProps({
    code: { type: String, required: true },
    street: { type: String, required: true },
    street_nr: { type: Number, required: true },
    city: { type: String, required: true },
})
</script>
