<template lang="pug">
#authenticated-layout--component-wrapper
    header(v-if="$slots.header")
        slot(name="header")

    main
        slot
</template>
