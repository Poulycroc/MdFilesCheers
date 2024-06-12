<template lang="pug">
.markdown-editor--editor--component-wrapper.full_h.full
    code-mirror-editor(
        v-model="code"
        :file-id="fileId"
        @saveContent="saveContent"
    )
</template>

<script setup lang="ts">
import { ref, type Ref } from 'vue';
import axios from 'axios';
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

console.log({ fileId: props.file.data.id, FILE: props.file });

const fileId: Ref<string> = ref(props.file.data.id);
const code: Ref<string> = ref(props.file.data.content);
const isAutoSaveLoading: Ref<boolean> = ref(false);


const saveContent = async (content: string) => {
    try {
        isAutoSaveLoading.value = true;
        await axios.post(`/api/editor/save-content/${fileId.value}`, { content });
    } catch (error) {
        console.error('Failed to save content:', error);
    } finally {
        isAutoSaveLoading.value = false;
    }
};
</script>
