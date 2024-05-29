<script setup lang="ts">
import { watch } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

defineProps<{
    canResetPassword?: boolean;
    status?: string;
    errors?: object;
}>();

const loginFormPayload = useForm({
    email: '',
    password: '',
    remember: false,
});

const onSubmit = () => {
    loginFormPayload.post(route('login'), {
        onFinish: () => loginFormPayload.reset('password'),
    });
};


watch(status, async (change) => {
    console.log({ change });
});
</script>

<template lang="pug">
GuestLayout
    Head
        div(v-if="status") {{ status }}

    el-card.login-container-card
        .clearfix.full.push_b_10(v-if="errors")
            el-alert(
                title="Error"
                type="error"
                :closable="false"
                :description="errors.email ? errors.email : 'Invalid credentials'"
            )

        el-form(
            ref="loginForm"
            label-position="top"
            :model="loginFormPayload"
        )
            el-form-item(label="Email" prop="email")
                el-input(v-model="loginFormPayload.email" autofocus)

            el-form-item(label="Password" prop="password")
                el-input(v-model="loginFormPayload.password" type="password")

            el-form-item(label="Remember Me")
                el-checkbox(v-model="loginFormPayload.remember")

            .clearfix.full
                el-button(type="primary" @click="onSubmit") Login
            .clearfix.full
                el-link(
                    v-if="canResetPassword"
                    :href="route('password.request')"
                )
                    |   Forgot Your Password?
</template>
