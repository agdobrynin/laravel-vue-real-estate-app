<template>
    <div>
        <ApartmentAddressWithPrice
            :price="apartment.price"
            :city="apartment.city"
            :street_nr="apartment.street_nr"
            :street="apartment.street"
        />
    </div>
</template>

<script setup>
import ApartmentAddressWithPrice from "@/Components/ApartmentAddressWithPrice.vue";

defineProps({apartment: Object})
</script>

<style scoped>

</style>
