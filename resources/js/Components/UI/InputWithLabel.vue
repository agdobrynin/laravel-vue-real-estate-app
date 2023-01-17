<template>
  <label class="label">{{ label }}</label>
  <input v-maska:[maskaOptions] :value="modelValue" type="text" class="input" @input="fieldUpdate" />
  <div v-if="error" class="input-error"> {{ error }}</div>
</template>

<script setup>
const props = defineProps({
    modelValue: {type: [String, Number, null], required: true},
    modelModifiers: { default: () => ({}) },
    label: {type: String, required: true},
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
