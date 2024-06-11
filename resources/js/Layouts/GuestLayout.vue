<template lang="pug">
#guest-layout--component-wrapper.full_viewport
    header(v-if="$slots.header")
        slot(name="header")

    main(:class="{ 'centered_middle_container': contentCentered }")
        slot
</template>

<script setup lang="ts">
defineProps<{
    contentCentered?: boolean;
}>();
</script>
