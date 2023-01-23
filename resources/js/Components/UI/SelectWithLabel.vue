<template>
  <div>
    <label v-if="label" :for="id" class="label">{{ label }}</label>
    <select
      :id="id"
      v-model="initValue"
      class="input"
      :class="inputClass"
      @change="$emit('update:modelValue', $event.target.value)"
    >
      <option v-for="o in options" :key="o" :value="o.value">{{ o.text }}</option>
    </select>
    <div v-if="error" class="input-error"> {{ error }}</div>
  </div>
</template>

<script setup>
import { randomString } from '@/Utils/helpers'
import { ref } from 'vue'

const props = defineProps({
    modelValue: { type: [String, Number, null] },
    options: { type: Array, required: true },
    label: { type: [String, undefined, null] },
    placeholder: { type: [String, undefined] },
    inputClass: { type: String, undefined },
    id: { type: [String, undefined], default: () => randomString() },
    error: { type: [String] },
})

const initValue = ref(props.modelValue)

defineEmits(['update:modelValue'])
</script>
