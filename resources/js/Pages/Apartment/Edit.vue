<template>
  <form @submit.prevent="update">
    <div class="grid grid-cols-6 gap-4">
      <div class="col-span-2">
        <label class="label">Beds</label>
        <input v-model.number="form.beds" type="text" class="input" />
        <div v-if="form.errors.beds" class="error"> {{ form.errors.beds }}</div>
      </div>
      <div class="col-span-2">
        <label class="label">Baths</label>
        <input v-model.number="form.baths" type="text" class="input" />
        <div v-if="form.errors.baths" class="error"> {{ form.errors.baths }}</div>
      </div>
      <div class="col-span-2">
        <label class="label">Area</label>
        <input v-model.number="form.area" type="text" class="input" />
        <div v-if="form.errors.area" class="error"> {{ form.errors.area }}</div>
      </div>
      <div class="col-span-2">
        <label class="label">City</label>
        <input v-model.trim="form.city" type="text" class="input" />
        <div v-if="form.errors.city" class="error"> {{ form.errors.city }}</div>
      </div>
      <div class="col-span-2">
        <label class="label">Street</label>
        <input v-model.trim="form.street" type="text" class="input" />
        <div v-if="form.errors.street" class="error"> {{ form.errors.street }}</div>
      </div>
      <div class="col-span-2">
        <label class="label">Postal code</label>
        <input v-model.trim="form.code" type="text" class="input" />
        <div v-if="form.errors.code" class="error"> {{ form.errors.code }}</div>
      </div>
      <div class="col-span-2">
        <label class="label">Street number</label>
        <input v-model.number="form.street_nr" type="text" class="input" />
        <div v-if="form.errors.street_nr" class="error"> {{ form.errors.street_nr }}</div>
      </div>
      <div class="col-span-2">
        <label class="label">Price</label>
        <input v-model.number="form.price" type="text" class="input" />
        <div v-if="form.errors.price" class="error"> {{ form.errors.price }}</div>
      </div>
      <div class="col-span-6">
        <button type="submit" class="button-primary">Update</button>
      </div>
    </div>
  </form>
</template>

<script setup>
import {useForm} from '@inertiajs/inertia-vue3'

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

<style scoped>
.error {
    color: red;
}
</style>
