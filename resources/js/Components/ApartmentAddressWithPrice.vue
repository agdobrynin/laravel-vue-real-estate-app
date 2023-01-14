<template>
    <span>
        {{ street }} {{ street_nr }}, {{ city }} for price ${{ price }}
    </span>
</template>

<script setup>
defineProps({
    street: {type: String, required: true},
    street_nr: {type: Number, required: true},
    city: {type: String, required: true},
    price: {type: Number, required: true},
})
</script>
