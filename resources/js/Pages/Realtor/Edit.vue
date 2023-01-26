<template>
  <div class="w-1/2 mx-auto">
    <form-apartment
      button-title="Update"
      :form-apartment="form"
      @on-submit="onSubmit"
    />
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import FormApartment from '@/Pages/Apartment/Components/FormApartment.vue'

const props = defineProps({ apartment: Object })

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

const onSubmit = () => form.put(route('realtor.apartment.update', { apartment: props.apartment.id }))
</script>
