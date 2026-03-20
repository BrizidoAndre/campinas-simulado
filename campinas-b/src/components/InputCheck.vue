<script setup>
import {useId} from "vue";

const model = defineModel();
const id = useId();
defineOptions({
  inheritAttrs: false
})
</script>

<template>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" :id="id" v-bind="$attrs" v-model="model">
    <label class="form-check-label" :for="id">
      <slot></slot>
    </label>
  </div>
</template>