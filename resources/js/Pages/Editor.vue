<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MainEditorViewer from '@/Modules/EditorModule/components/MainEditorViewer.vue';

const props = defineProps<{
    allFilesTree?: object[];
    file?: object;
    path?: string;
}>();
</script>

<template lang="pug">
head(title="Editor")

authenticated-layout
    main-editor-viewer(
        :all-files-tree="allFilesTree"
        :file="file"
        :path="path"
    )
</template>
