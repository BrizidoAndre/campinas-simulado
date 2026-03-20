import {reactive, watch} from "vue";
import {storage} from "@/utils/storage.js";

/**
 * config to be applied in all application
 */
export const slideConfig = reactive({
    darkTheme: storage.get('darkTheme', 'false'),
    slideDuration: 2,
    slideScrollingSpeed: 1,
    mode: 'manual',
    theme: 'A',
    paused: false,
})

watch(slideConfig, value => {
    storage.set('config', value);
})

watch(() => slideConfig.darkTheme, value => {
    document.body.dataset.bsTheme = value ? 'dark' : 'light';
    storage.set('darkTheme',value);
}, {
    immediate: true
})

export function getRandomInt(max) {
    return Math.floor(Math.random() * max);
}
