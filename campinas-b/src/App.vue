<script setup>
import TheAside from "@/components/TheAside.vue";
import {onMounted, ref, watch} from "vue";
import CommandBar from "@/components/CommandBar.vue";
import {getRandomInt, slideConfig} from "@/utils/utils.js";
import first from '@/assets/Sample Photos/basilique-notre-dame-de-fourviere-lyon.jpg'
import second from '@/assets/Sample Photos/beautiful-view-in-lyon.jpg'
import third from '@/assets/Sample Photos/place-bellecour-lyon.jpg'
import forth from '@/assets/Sample Photos/tour-metalique-lyon.jpg'
import ThemeA from "@/components/ThemeA.vue";
import ThemeB from "@/components/ThemeB.vue";
import ThemeC from "@/components/ThemeC.vue";
import ThemeD from "@/components/ThemeD.vue";
import {storage} from "@/utils/storage.js";

const showCommand = ref(false);
const slides = ref([]);
const slideIndex = ref(0);
let slideInterval = null
const themes = {
  'A': ThemeA,
  'B': ThemeB,
  'C': ThemeC,
  'D': ThemeD,
}

function handleKeyPress(ev) {
  let {ctrlKey, key} = ev;
  if (ctrlKey && key.toUpperCase() === 'K' || key === '/') {
    ev.preventDefault()
    showCommand.value = true;
  } else if (key === 'Escape') {
    ev.preventDefault()
    showCommand.value = false;
  }
}

function handleCommand(index) {
  switch (index) {
    case 0:
      slideConfig.mode = 'manual';
      break;
    case 1:
      slideConfig.mode = 'auto';
      break;
    case 2:
      slideConfig.mode = 'random';
      break;
    case 3:
      slideConfig.theme = 'A';
      break;
    case 4:
      slideConfig.theme = 'B';
      break;
    case 5:
      slideConfig.theme = 'C';
      break;
    case 6:
      slideConfig.theme = 'D';
      break;
    case 7:
      slideConfig.darkTheme = !slideConfig.darkTheme;
      break;
    case 8:
      shufflePhotos();
      break;
    case 9:
      slideConfig.paused = true;
      break;
    case 10:
      slideConfig.paused = false;
      break;
  }
  showCommand.value = false;
}

function shufflePhotos() {
  slides.value.sort((a, b) => Math.random() - .5);
}

function removeFileName(url) {
  const fileNameUrl = url.split('.');
  let fileName = fileNameUrl[0].toString();
  fileName = fileName.replaceAll('-', ' ');
  let words = fileName.split(' ');
  let capitalize = words.map(word => {
    return word[0].toUpperCase() + word.slice(1);
  })
  return capitalize.join(' ');
}

function loadDefaultPhotos() {
  slideIndex.value = 0;
  slides.value = [
    {
      caption: removeFileName('basilique-notre-dame-de-fourviere-lyon.jpg'),
      image: first,
    },
    {
      caption: removeFileName('beautiful-view-in-lyon.jpg'),
      image: second,
    },
    {
      caption: removeFileName('place-bellecour-lyon.jpg'),
      image: third,
    },
    {
      caption: removeFileName('tour-metalique-lyon.jpg'),
      image: forth,
    },
  ]
}

function handleDrop(ev) {
  slideIndex.value = 0;
  let files = [...ev.dataTransfer.files];
  // todo filtering equal data
  let filteredFiles = files.filter((file, index) => {
    return files.some(insideFile => file.name === insideFile.name);
  })
  console.log(filteredFiles);
  filteredFiles.forEach(file => {
    const url = URL.createObjectURL(file);
    const caption = removeFileName(file.name);
    slides.value.push({
      caption: caption,
      image: url,
    })
  })
}

// change slide to the next one based on key press
function changeSlide(ev) {
  let {key} = ev;
  if (key === 'ArrowRight') {
    slideIndex.value = (slideIndex.value + 1) % slides.value.length;
  } else if (key === 'ArrowLeft') {
    slideIndex.value = (slideIndex.value + slides.value.length - 1) % slides.value.length;
  }
}

// change mode based on slideConfig definition
function changeMode() {
  clearInterval(slideInterval);
  window.removeEventListener('keydown', changeSlide);
  if (!slideConfig.paused) {
    if (slideConfig.mode === 'manual') {
      window.addEventListener('keydown', changeSlide)
    } else if (slideConfig.mode === 'auto') {
      let during = parseInt(slideConfig.slideDuration);
      slideInterval = setInterval(() => {
        slideIndex.value = (slideIndex.value + 1) % slides.value.length;
      }, during * 1000)
    } else if (slideConfig.mode === 'random') {
      let during = parseInt(slideConfig.slideDuration);
      slideInterval = setInterval(() => {
        let newIndex;
        do {
          newIndex = getRandomInt(slides.value.length);
        } while (newIndex === 0);
        slideIndex.value = (slideIndex.value + newIndex) % slides.value.length;
      }, during * 1000)
    }
  } else {
    alert('The slide is paused')
  }
}

// if anything is changed in slideConfig the change mode is reseted
watch(slideConfig, value => {
  changeMode()
}, {
  immediate: true
})

// add command bar press
onMounted(() => {
  window.addEventListener('keydown', handleKeyPress)
})
</script>

<template>
  <the-aside v-model:slides="slides"/>
  <command-bar v-if="showCommand" @handle-command="handleCommand"/>
  <div v-if="slides.length < 1" class="drop-area" @dragover.prevent @drop.prevent="handleDrop">
    <p>Drop your files here</p>
    <button class="btn btn-primary" @click="loadDefaultPhotos">Load Sample Photos</button>
  </div>
  <component v-else :is="themes[slideConfig.theme]" v-model:slides="slides" v-model:slideIndex="slideIndex"
             :slideIndexProp="slideIndex"/>
</template>

<style>
.drop-area {
  width: min(90%, 400px);
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  border: 3px black dotted;
  padding: 3rem;
  border-radius: .5rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 1rem;
  z-index: 1;
}
</style>