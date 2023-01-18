<template>
  <form @submit.prevent="onSubmit">
    <div class="grid grid-cols-6 gap-4">
      <div class="col-span-2">
        <InputWithLabel
          v-model.number="form.beds" label="Beds" :error="form.errors.beds"
          :maska-options="{mask: '##'}"
        />
      </div>
      <div class="col-span-2">
        <InputWithLabel
          v-model.number="form.baths" label="Baths" :error="form.errors.baths"
          :maska-options="{mask: '##'}"
        />
      </div>
      <div class="col-span-2">
        <InputWithLabel
          v-model.number="form.area" label="Area" :error="form.errors.area"
          :maska-options="{mask: '###'}"
        />
      </div>
      <div class="col-span-2">
        <InputWithLabel v-model.trim="form.city" label="City" :error="form.errors.city" />
      </div>
      <div class="col-span-2">
        <InputWithLabel v-model.trim="form.street" label="Street" :error="form.errors.street" />
      </div>
      <div class="col-span-2">
        <InputWithLabel v-model.number="form.street_nr" label="Street number" :error="form.errors.street_nr" />
      </div>
      <div class="col-span-2">
        <InputWithLabel
          v-model.trim="form.code" label="Postal code" :error="form.errors.code"
          :maska-options="{mask: '#####-####'}"
        />
      </div>
      <div class="col-span-2">
        <InputWithLabel
          v-model.number="form.price"
          label="Price"
          :maska-options="{mask: '9 99#', returnUnmasked: true, reversed:true, tokens: {'9': {pattern: '[0-9]', repeated: true, multiple: true}}}"
          :error="form.errors.price"
        />
      </div>
      <div class="col-span-6">
        <button type="submit" class="button-primary">{{ buttonTitle }}</button>
      </div>
    </div>
  </form>
</template>

<script setup>
import InputWithLabel from '@/Components/UI/InputWithLabel.vue'
import {reactive} from 'vue'

const props = defineProps({
    apartment: Object,
    buttonTitle: String,
})
const form = reactive(props.apartment)
const emit = defineEmits(['onSubmit'])

const onSubmit = () => {
    emit('onSubmit', form)
}
</script>
