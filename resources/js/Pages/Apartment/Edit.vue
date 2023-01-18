<template>
  <FormApartment button-title="Update" :apartment="form" @on-submit="onSubmit" />
</template>

<script setup>
import {useForm} from '@inertiajs/inertia-vue3'
import FormApartment from '@/Pages/Apartment/Components/FormApartment.vue'

const props = defineProps({apartment: Object})

const form = useForm({
    beds: props.apartment.beds,
    baths: props.apartment.baths,
    area: props.apartment.area,
    city: props.apartment.city,
    code: props.apartment.code,
    street: props.apartment.street,
    street_nr: props.apartment.street_nr,
    price: props.apartment.price,
})

const onSubmit = () => form.put(route('apartment.update', {apartment: props.apartment.id}))
</script>
