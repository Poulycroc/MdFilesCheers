<template lang="pug">
code-mirror.code-mirror--wrapper-component(
    v-model="code"
    basic
    :dark="dark"
    :lang="lang"
    @change="handleCodeChange"
)
</template>

<script lang="ts" setup>
import { ref, watch, type Ref } from 'vue';
import { debounce } from 'lodash';
import CodeMirror from 'vue-codemirror6';
import { markdown as md } from '@codemirror/lang-markdown';
import type { LanguageSupport } from '@codemirror/language';
import type { Extension } from '@codemirror/state';
import type { ViewUpdate } from '@codemirror/view';

const emit = defineEmits(["update:modelValue", "saveContent"]);
const props = defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    fileId: {
        type: [Number, String],
        required: true,
    },
});

const code: Ref<string> = ref(props.modelValue);
const dark: Ref<boolean> = ref(
  window.matchMedia('(prefers-color-scheme: light)').matches
);

/**
 * CodeMirror Language
 *
 * @see {@link https://codemirror.net/6/docs/ref/#language | @codemirror/language}
 */
const lang: LanguageSupport = md();


// Methods
const saveToLocalStorage = (content: string) => {
    if (!props.fileId) return;
    localStorage.setItem(`draft-${props.fileId}`, content);
};


const handleSaveContent = debounce((content: string) => {
    saveToLocalStorage(content);
    emit('saveContent', content);
}, 2000);

/**
 * Handle code change
 *
 * @param {ViewUpdate} viewUpdate
 */
const handleCodeChange = (viewUpdate: ViewUpdate) => {
    code.value = viewUpdate.doc.toString();
    emit('update:modelValue', code.value);
    handleSaveContent(code.value);
};

/**
 * Watch modelValue
 */
watch(() => props.modelValue, (newValue) => {
    code.value = newValue;
    saveToLocalStorage(newValue);
});
</script>
