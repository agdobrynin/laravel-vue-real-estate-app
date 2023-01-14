<template>
  <form @submit.prevent="create">
    <div>
      <label for="">Beds</label>
      <input v-model.number="form.beds" type="text" />
    </div>
    <div>
      <label for="">Baths</label>
      <input v-model.number="form.baths" type="text" />
    </div>
    <div>
      <label for="">Area</label>
      <input v-model.number="form.area" type="text" />
    </div>
    <div>
      <label for="">City</label>
      <input v-model.trim="form.city" type="text" />
    </div>
    <div>
      <label for="">Street</label>
      <input v-model.trim="form.street" type="text" />
    </div>
    <div>
      <label for="">Postal code</label>
      <input v-model.trim="form.code" type="text" />
    </div>
    <div>
      <label for="">Street number</label>
      <input v-model.number="form.street_nr" type="text" />
    </div>
    <div>
      <label for="">Price</label>
      <input v-model.number="form.price" type="text" />
    </div>
    <div>
      <button type="submit">Create</button>
    </div>
  </form>
</template>

<script setup>
import {useForm} from '@inertiajs/inertia-vue3'

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

const create = () => form.post('/apartment')
</script>

<style scoped>
label {
    margin-right: 1rem;
}
div {
    padding: 0.5rem;
}
</style>
