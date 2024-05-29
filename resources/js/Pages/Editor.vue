<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import AsideFilesNavigation from '@/Components/AsideFilesNavigation.vue';
</script>

<template lang="pug">
head(title="Editor")

authenticated-layout
    el-container
        AsideFilesNavigation
        el-container
            el-header
            el-main
                el-button(type="primary") You're test test test
</template>
