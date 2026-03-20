<script setup>
import {onMounted, onUnmounted, ref} from "vue";

const currentIndex = ref(0);
// each command bar option label
const options = [
  'Change to manual control mode',
  'Change to manual auto-playing mode',
  'Change to random playing mode',
  'Switch to theme A',
  'Switch to theme B',
  'Switch to theme C',
  'Switch to theme D',
  'Toggle light and dark mode',
  'Shuffle photos',
  'Pause slideshow',
  'Play slideshow'
];

const emits = defineEmits(['handleCommand'])

function handleKey(ev) {
  let {key} = ev;
  if (key === 'ArrowDown') {
    currentIndex.value = (currentIndex.value + 1) % options.length;
  } else if (key === 'ArrowUp') {
    currentIndex.value = (currentIndex.value + options.length - 1) % options.length;
  } else if (key === 'Enter') {
    emits('handleCommand', currentIndex.value);

  }
}

onMounted(() => {
  window.addEventListener('keydown', handleKey);
})
onUnmounted(() => {
  window.removeEventListener('keydown', handleKey)
})
</script>

<template>
  <div class="bg-command">
    <div class="command p-3 rounded-3 bg-body-tertiary">
      <p class="display-6">Command Bar</p>
      <ul class="list-group">
        <li v-for="(option,i) in options" class="list-group-item" :class="[currentIndex === i && 'active']">
          {{ option }}
        </li>
      </ul>
    </div>
  </div>
</template>

<style scoped>
.bg-command {
  position: fixed;
  display: flex;
  justify-content: center;
  align-items: center;
  background: rgba(0, 0, 0, 0.4);
  height: 100vh;
  width: 100vw;
  z-index: 2;
}
</style>