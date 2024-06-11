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
</script>

<template lang="pug">
guest-layout(content-centered)
    Head
        div(v-if="status") {{ status }}

    el-card.login-container-card
        el-form(
            ref="loginForm"
            label-position="top"
            :model="loginFormPayload"
        )
            el-form-item(label="Email" prop="email")
                el-input(v-model="loginFormPayload.email" autofocus)

            el-form-item(label="Password" prop="password")
                el-input(v-model="loginFormPayload.password" type="password")

            el-checkbox(v-model="loginFormPayload.remember" label="Remember me")

            .clearfix.full
                el-button.full.push_t_10(type="primary" @click="onSubmit") Login
            .clearfix.full.pull_end.push_t_10
                el-link(
                    v-if="canResetPassword"
                    :href="route('password.request')"
                )
                    |   Forgot Your Password?
</template>
