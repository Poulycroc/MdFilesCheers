<template lang="pug">
el-aside(width="200px")
    el-scrollbar
        el-menu(:default-openeds="['1', '3']")
            el-sub-menu(index="1")
                template(v-slot:title)
                    el-icon
                        message
                    | Navigator One
                el-menu-item-group
                    template(v-slot:title) Group 1
                    el-menu-item(index="1-1") Option 1
                el-menu-item-group(title="Group 2")
                    el-menu-item(index="1-3")
</template>
