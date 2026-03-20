<script setup>
import {computed} from "vue";
import {slideConfig} from "@/utils/utils.js";

const slides = defineModel('slides');
const slideIndex = defineModel('slideIndex');
const currentObject = computed(() => {
  return slides.value[slideIndex.value];
})
</script>

<template>
  <div class="container-outside">
    <Transition name="slide">
      <div class="container-slide" :key="slideIndex">
        <img :src="currentObject?.image" :alt="currentObject?.caption" class="image-slide">
        <p class="caption bg-body-tertiary">
          <span v-for="(word,i) in currentObject?.caption.split(' ')" :style="{
            '--delay':(i * .3) + 's'
          }">
          {{ word }}
          </span>
        </p>
      </div>
    </Transition>
  </div>
</template>

<style scoped>
.container-outside {
  position: absolute;
  left: 0;
  top: 0;
  width: 100vw;
  height: 100vh;
  overflow: hidden;
}

.container-slide {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
}

.image-slide {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.caption {
  text-transform: capitalize;
  position: absolute;
  left: 0;
  bottom: 0;
  padding: 1rem;
  border-radius: .5rem;
  margin: 0;
  display: flex;
  gap: .25rem;
}

.caption span {
  transform: translateY(100%);
  opacity: 0;
  animation: slide .3s forwards linear var(--delay);
}

@keyframes slide {
  from {
    transform: translateY(100%);
    opacity: 0;
  }
  to {
    transform: translateY(0%);
    opacity: 1;
  }
}

.slide-enter-from {
  transform: translateY(100%);
}

.slide-enter-active,
.slide-leave-active {
  transition: .4s;
}

.slide-leave-to {
  transform: translateY(-100%);
}
</style>