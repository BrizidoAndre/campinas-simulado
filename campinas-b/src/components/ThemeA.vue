<script setup>
import {computed} from "vue";

const slides = defineModel('slides');
const slideIndex = defineModel('slideIndex');
const props = defineProps(['slideIndexProp'])
const currentObject = computed(() => {
  return slides.value[slideIndex.value];
})
</script>

<template>
  <div class="container-outside">
    <Transition>
      <div class="container-slide" :key="props.slideIndexProp">
        <img :src="currentObject?.image" :alt="currentObject?.caption" class="image-slide">
        <div class="caption bg-body-tertiary">
          <input type="text" v-model="slides[slideIndex].caption" class="input-pure">
        </div>
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
}

.input-pure {
  border: none;
}
</style>