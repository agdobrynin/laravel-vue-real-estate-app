<template>
  <div>
    <label v-if="label" :for="id" class="label">{{ label }}</label>
    <input :id="id" v-maska:[maskaOptions] :placeholder="placeholder" :value="modelValue" :type="fieldType" class="input" :class="inputClass" @input="fieldUpdate" />
    <div v-if="error" class="input-error"> {{ error }}</div>
  </div>
</template>

<script setup>
import {randomString} from '@/Utils/helpers'

const props = defineProps({
    modelValue: {type: [String, Number, null], required: true},
    modelModifiers: { type: Object, default: () => ({}) },
    label: {type: [String, undefined, null]},
    placeholder: {type: [String, undefined]},
    inputClass: {type: String, undefined},
    id: {type: [String, undefined], default: () => randomString()},
    fieldType: {type: String, default: 'text'},
    error: {type: [String]},
    maskaOptions: {type: Object},
})

const emit = defineEmits(['update:modelValue'])

const fieldUpdate = (event) => {
    if (event?.detail) {
        const value = props.maskaOptions?.returnUnmasked ? event.detail.unmasked : event.detail.masked
        emit('update:modelValue', value)
    }
}
</script>
