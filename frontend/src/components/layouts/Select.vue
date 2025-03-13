<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
  modelValue: String,
  label: String,
  id: String,
  options: {type: Array, default: () => []},
  optionValueKey: { type: String, default: 'id' },
  optionLabelKey: { type: String, default: 'name' },
  required: {type: Boolean, default: false}, // Required field
});

const emit = defineEmits(['update:modelValue']);
const updateValue = (event) => {
  emit('update:modelValue', event.target.value);
};
</script>

<template>
  <div class="mb-4">
    <label v-if="label" class="form-label" :for="id">{{ label }}</label>
    <select
        :id="id"
        class="select2 form-select"
        :value="modelValue"
        :required="required"
        @change="updateValue"
    >
      <option value="">Select an option</option>
      <option v-for="option in options" :key="option[optionValueKey]" :value="option[optionValueKey]">
        {{ option[optionLabelKey]}}
      </option>
    </select>
  </div>
</template>
