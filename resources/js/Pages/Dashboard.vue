<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template lang="pug">
head(title="Dashboard")

authenticatedLayout
    template#header
        h2 Dashboard

    el-button(type="primary") You're test test test
</template>
