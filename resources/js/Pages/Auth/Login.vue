<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetCheckbox from '@/Jetstream/Checkbox.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />

    <JetAuthenticationCard>
        <template #logo>
            <JetAuthenticationCardLogo />
        </template>

        <JetValidationErrors class="mb-4" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <JetLabel for="email" value="Email" />
                <JetInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
            </div>

            <div class="mt-4">
                <JetLabel for="password" value="Password" />
                <JetInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="current-password"
                />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <JetCheckbox v-model:checked="form.remember" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Forgot your password?
                </Link>

                <JetButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </JetButton>
            </div>
        </form>

        <div class="py-4 m-auto">
            <hr class="py-2" />
            <div class="py-1">
                <a :href="route('google.login')" type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-slate-500 hover:border-black text-sm font-medium rounded text-black focus:outline-none">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <img width="18" src="img/google-logo.png" />
                    </span>
                    Sign in with Google
                </a>
            </div>

            <div class="py-1">
                <a :href="route('microsoft.login')" type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-slate-500 hover:border-black text-sm font-medium rounded text-black focus:outline-none">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <img width="18" src="img/microsoft-logo.svg" />
                    </span>
                    Sign in with Microsoft
                </a>
            </div>
        </div>

        <div class="py-4 m-auto">
            <hr class="py-2" />
            Need an account?
            <Link :href="route('register')" class="underline text-sm text-gray-600 hover:text-gray-900">
                Register here.
            </Link>
        </div>

    </JetAuthenticationCard>
</template>
