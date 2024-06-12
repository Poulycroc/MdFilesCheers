<template lang="pug">
.markdown-editor--editor--component-wrapper.full_h.full
    code-mirror-editor(
        v-model="code"
        class="markdown-editor--textarea.full_h.full"
    )
</template>

<script setup lang="ts">
import { ref, type Ref } from 'vue';
import CodeMirrorEditor from './CodeMirrorEditor.vue';

const props = defineProps({
    file: {
        type: Object,
        required: true,
        default: () => ({}),
    },
    path: {
        type: String,
        required: false,
        default: null,
    },
});

const code: Ref<string> = ref(props.file.data.content);
</script>
