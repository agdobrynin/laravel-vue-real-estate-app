<template>
  <form @submit.prevent="update">
    <div class="grid grid-cols-6 gap-4">
      <div class="col-span-2">
        <InputWithLabel v-model.number="form.beds" label="Beds" :error="form.errors.beds" />
      </div>
      <div class="col-span-2">
        <InputWithLabel v-model.number="form.baths" label="Baths" :error="form.errors.baths" />
      </div>
      <div class="col-span-2">
        <InputWithLabel v-model.number="form.area" label="Area" :error="form.errors.area" />
      </div>
      <div class="col-span-2">
        <InputWithLabel v-model.trim="form.city" label="City" :error="form.errors.city" />
      </div>
      <div class="col-span-2">
        <InputWithLabel v-model.trim="form.street" label="Street" :error="form.errors.street" />
      </div>
      <div class="col-span-2">
        <InputWithLabel v-model.trim="form.code" label="Postal code" :error="form.errors.code" />
      </div>
      <div class="col-span-2">
        <InputWithLabel v-model.number="form.street_nr" label="Street number" :error="form.errors.street_nr" />
      </div>
      <div class="col-span-2">
        <InputWithLabel v-model.number="form.price" label="Price" :error="form.errors.price" />
      </div>
      <div class="col-span-6">
        <button type="submit" class="button-primary">Update</button>
      </div>
    </div>
  </form>
</template>

<script setup>
import {useForm} from '@inertiajs/inertia-vue3'
import InputWithLabel from '@/Components/UI/InputWithLabel.vue'

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

const update = () => form.put(route('apartment.update', {apartment: props.apartment.id}))
</script>
