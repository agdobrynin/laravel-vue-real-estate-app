<template>
    <div>INDEX</div>
    <p>{{ message }}</p>
</template>

<script setup>

defineProps({
    message: {type: String, required: true},
});
</script>
