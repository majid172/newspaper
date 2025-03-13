<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
  modelValue: String,
  label: String,
  id: String,
  type: { type: String, default: 'text' },
  placeholder: String,
  icon: String,
  required: { type: Boolean, default: false },
});

const emit = defineEmits(['update:modelValue']);
const updateValue = (event) => {
  emit('update:modelValue', event.target.value);
};
</script>

<template>
  <div class="mb-3">
    <label class="form-label" :for="id">{{ label }}</label>
    <div class="input-group input-group-merge">
      <span class="input-group-text">
        <i :class="icon"></i>
      </span>
      <input
          :type="type"
          class="form-control"
          :id="id"
          :placeholder="placeholder"
          :value="modelValue"
          :required="required"
          @input="updateValue"
      />
    </div>
  </div>
</template>
