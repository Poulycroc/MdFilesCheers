<template lang="pug">
code-mirror(
    v-model="code"
    basic
    :dark="dark"
    :lang="lang"
    @change="handleCodeChange"
)
</template>

<script lang="ts" setup>
import { ref, type Ref } from 'vue';

import CodeMirror from 'vue-codemirror6';
import { markdown as md } from '@codemirror/lang-markdown';
import type { LanguageSupport } from '@codemirror/language';
import type { Extension } from '@codemirror/state';
import type { ViewUpdate } from '@codemirror/view';

const props = defineProps({
  modelValue: {
    type: String,
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

const handleCodeChange = (viewUpdate: ViewUpdate) => {
    // code.value = viewUpdate.state.doc.toString();
    console.log({ viewUpdate });
};
</script>

