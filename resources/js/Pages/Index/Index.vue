<template>
  <h1> {{ message }}</h1>
</template>

<script setup>
defineProps({
    message: { type: String, default: 'I am default value' },
})
</script>
