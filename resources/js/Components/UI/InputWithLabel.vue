<template>
  <label class="label">{{ label }}</label>
  <input :value="modelValue" type="text" class="input" @input="$emit('update:modelValue', $event.target.value)" />
  <div v-if="error" class="input-error"> {{ error }}</div>
</template>

<script setup>
defineProps({
    modelValue: {type: [String, Number, null], required: true},
    modelModifiers: { default: () => ({}) },
    label: {type: String, required: true},
    error: {type: [String]},
})

defineEmits(['update:modelValue'])
</script>
