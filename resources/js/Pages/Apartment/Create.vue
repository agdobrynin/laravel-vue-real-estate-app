<template>
  <FormApartment button-title="Create" :apartment="form" @on-submit="create" />
</template>

<script setup>
import {useForm} from '@inertiajs/inertia-vue3'
import FormApartment from '@/Pages/Apartment/Components/FormApartment.vue'

const form = useForm({
    beds: 1,
    baths: 0,
    area: 0,
    city: null,
    code: null,
    street: null,
    street_nr: null,
    price: 0,
})

const create = () => form.post(route('apartment.store'))
</script>
