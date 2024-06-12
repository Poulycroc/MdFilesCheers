<template lang="pug">
.main-enditor-viewer--component-wrapper.full_viewport
    split-pane(:min-percent="5" :default-percent="20" split="vertical")
        template(v-slot:paneL)
            tree-viewer-header
            tree-viewer(:all-files-tree="allFilesTree")
        template(v-slot:paneR)
            top-header(:file="file" :path="path")

            main.editor-main-container.full.full_h
                split-pane(
                    split="vertical"
                    :min-percent="0"
                    :default-percent="isMarkdownPrettyViewerOpen ? 50 : 100"
                )
                    template(v-slot:paneL)
                        markdown-editor(:file="file" :path="path")
                    template(
                        v-if="isMarkdownPrettyViewerOpen"
                        v-slot:paneR)
</template>

<script setup lang="ts">
import { ref, defineAsyncComponent } from "vue";
import TopHeader from '@/Modules/EditorModule/components/TopHeader.vue';
import TreeViewerHeader from '@/Modules/EditorModule/components/TreeViewerHeader.vue';
import TreeViewer from '@/Modules/EditorModule/components/TreeViewer.vue';
import MarkdownEditor from '@/Modules/EditorModule/components/MarkdownEditor.vue';

const SplitPane = defineAsyncComponent(() => import("split-pane-v3"));

const isMarkdownPrettyViewerOpen = ref<boolean>(false);

const props = defineProps<{
    allFilesTree?: object[];
    file?: object;
    path?: string;
}>();

console.log({ props })

</script>
