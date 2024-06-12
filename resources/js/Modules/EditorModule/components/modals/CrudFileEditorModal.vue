<template lang="pug">
el-dialog.crud-file--modal--editor--component-wrapper(
    v-model="visible"
    append-to-body
    title="Create a new file"
    width="500"
)
    el-form(
        :model="createFilePayload"
        :rules="createFileRules"
        ref="createFileRef"
        label-position="top"
    )
        el-form-item(label="File name")
            el-input(
                v-model="createFilePayload.name"
                autocomplete="off"
            )

    template(v-slot:footer)
        el-button(@click="dialogFormVisible = false") Cancel
        el-button(type="primary" @click="submitCreateFileForm(createFileRef)") Confirm
</template>

<script lang="ts" setup>
import { ref, computed, reactive } from "vue";
import { useForm } from '@inertiajs/vue3';
import type { ComponentSize, FormInstance, FormRules } from 'element-plus'

const props = defineProps({
    modelValue: {
        type: Boolean,
        required: true,
        default: false,
    },
});
const emit = defineEmits(["update:modelValue"]);

const createFilePayload = useForm<RuleForm>({ name: '' });
const createFileRef = ref<FormInstance>();

const visible = computed({
    get() {
        return props.modelValue
    },
    set(value) {
        emit("update:modelValue", value)
    }
});

const createFileRules = reactive<FormRules<RuleForm>>({
  name: [
    { required: true, message: 'Please input Activity name', trigger: 'blur' },
    { min: 3, message: 'Length should be 3 to 5', trigger: 'blur' },
  ],
});

// methods
const submitCreateFileForm = async (formEl: FormInstance | undefined) => {
    if (!formEl) return
    await formEl.validate((valid, fields) => {
        if (!valid) return

        createFilePayload.post(route('editor.storeFile'), {
            onFinish: () => console.log('onFinish'),
        });
    })
};
</script>

<style scoped>
.my-header {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  gap: 16px;
}
</style>
