<template>
    <div v-for="item in list" :key="item.id">
        <Link :href="`/apartment/${item.id}`">
            <ApartmentAddressWithPrice
                :street="item.street"
                :street_nr="item.street_nr"
                :city="item.city"
                :price="item.price"
            />
        </Link>
    </div>
</template>

<script setup>
import {Link} from "@inertiajs/inertia-vue3";
import ApartmentAddressWithPrice from "@/Components/ApartmentAddressWithPrice.vue";

defineProps({
    list: Array
})
</script>
