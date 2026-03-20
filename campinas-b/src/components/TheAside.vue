<script setup>
import gear from '../assets/icons/settings.svg';
import pause from '../assets/icons/pause.svg';
import play from '../assets/icons/play.svg';
import InputRadio from "@/components/InputRadio.vue";
import {slideConfig} from "@/utils/utils.js";
import {ref} from "vue";
import InputLabel from "@/components/InputLabel.vue";
import InputSlide from "@/components/InputSlide.vue";
import InputCheck from "@/components/InputCheck.vue";

const slides = defineModel('slides');
const asideOpen = ref(false);
let startDrag = null;

function toggleFullscreen() {
  if (!document.fullscreenElement) {
    // If the document is not in full screen mode
    // make the video full screen
    document.documentElement.requestFullscreen();
  } else {
    // Otherwise exit the full screen
    document.exitFullscreen?.();
  }
}

/**
 * Getting started item and replacing in current dropped slide
 * @param currentIndex
 * @param draggableItem
 */
function changeImage(currentIndex, draggableItem) {
  const startDragged = slides.value[startDrag];
  const removed = slides.value[currentIndex];
  slides.value[currentIndex] = startDragged;
  slides.value[startDrag] = removed;
}

function beginDrag(index) {
  startDrag = index
}

// randomizing the order of the slides
function shuffleSlides() {
  slides.value.sort((a, b) => Math.random() - .5);
}
</script>

<template>
  <div>
    <img :src="gear" alt="Press to togle aside menu" role="button" class="btn-gear" @click="asideOpen = !asideOpen">
    <aside class="aside-website bg-body-tertiary" :class="[asideOpen && 'aside-open']">
      <h2>Operating Mode</h2>
      <input-radio name="mode" value="manual" v-model="slideConfig.mode">Manual</input-radio>
      <input-radio name="mode" value="auto" v-model="slideConfig.mode">Auto-playing</input-radio>
      <input-radio name="mode" value="random" v-model="slideConfig.mode">Random</input-radio>
      <h2>Active Theme</h2>
      <input-radio name="theme" value="A" v-model="slideConfig.theme">Theme A</input-radio>
      <input-radio name="theme" value="B" v-model="slideConfig.theme">Theme B</input-radio>
      <input-radio name="theme" value="C" v-model="slideConfig.theme">Theme C</input-radio>
      <input-radio name="theme" value="D" v-model="slideConfig.theme">Theme D</input-radio>
      <h2>Sorting photos</h2>
      <button class="btn btn-primary" @click="shuffleSlides">Shuffle</button>
      <p>*Order By draggin the number next to the image</p>
      <ul class="list-unstyled">
        <li v-for="(slide,i) in slides" class="my-1" draggable="true" @dragover.prevent
            @drop.prevent="changeImage(i,slide)"
            @mousedown="beginDrag(i)">
          <p class="d-inline">{{ i + 1 }} - </p>
          <img :src="slide.image" :alt="slide.caption" class="image-sort">
        </li>
      </ul>
      <h2>Playback settings</h2>
      <input-slide min="1" max="30" v-model="slideConfig.slideDuration">Slide duration {{ slideConfig.slideDuration }}
      </input-slide>
      <input-slide step=".1" min="3" max="10" v-model="slideConfig.slideScrollingSpeed">Slide Scrolling Speed
        {{ slideConfig.slideScrollingSpeed }}
      </input-slide>
      <div class="d-flex gap-2">
        <button class="btn-media">
          <img :src="play" alt="Press to resume the animation" class="image-media" @click="slideConfig.paused=false">
        </button>
        <button class="btn-media">
          <img :src="pause" alt="Press to pause the animation" class="image-media" @click="slideConfig.paused=true">
        </button>
      </div>
      <h2>Display Settings</h2>
      <input-check v-model="slideConfig.darkTheme">Dark theme</input-check>
      <button class="btn btn-primary" @click="toggleFullscreen">Fullscreen</button>
    </aside>
  </div>
</template>

<style scoped>
.btn-gear {
  width: 70px;
  aspect-ratio: 1;
  position: fixed;
  z-index: 2;
  top: 5%;
  left: 5%;
}

.aside-website {
  position: fixed;
  z-index: 2;
  right: 0;
  top: 0;
  padding: 2rem;
  background: rgba(0, 0, 0, .2);
  height: 100vh;
  overflow-y: scroll;
  transform: translateX(100%);
  transition: .4s;
}

.aside-open {
  transform: translateX(0%);
}

.image-sort {
  width: 150px;
}
</style>