<script setup>
import {useId} from "vue";

defineOptions({
  inheritAttrs: false,
})
const id = useId();
</script>

<template>
  <div class="mb-3">
    <label :for="id" class="form-label">
      <slot></slot>
    </label>
    <input
        class="form-control" :id="id"
        v-bind="$attrs"
        type="text"
    >
  </div>
</template>