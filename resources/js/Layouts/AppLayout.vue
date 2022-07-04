<script setup>
    import BaseLayout from '@/Layouts/BaseLayout.vue';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Notifications from '@/Layouts/Notifications.vue';
//import Alerts from '@/Components/Alerts.vue';
import ResponsiveLinks from '@/Layouts/ResponsiveLinks.vue';
import JetApplicationMark from '@/Jetstream/ApplicationMark.vue';
import JetBanner from '@/Jetstream/Banner.vue';
import JetDropdown from '@/Jetstream/Dropdown.vue';
import JetDropdownLink from '@/Jetstream/DropdownLink.vue';
import JetNavLink from '@/Jetstream/NavLink.vue';
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue';

defineProps({
    title: String,
    fullHeight: {
        type: Boolean,
        default: false
    },
    hasSidebar: {
        type: Boolean,
        default: false
    },
});

const showingNavigationDropdown = ref(false);

const logout = () => {
    Inertia.post(route('logout'));
};
</script>

<template>
    <BaseLayout :title="title">
        <template #links-left>
            <JetNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                Dashboard
            </JetNavLink>

            <Notifications />
        </template>

        <template #links-right>
            <JetDropdown align="right" width="48">
                <template #trigger>
                    <button v-if="$page.props.jetstream?.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                        <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name">
                    </button>

                    <span v-else class="inline-flex rounded-md">
                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                            {{ $page.props.user.name }}

                            <svg
                                class="ml-2 -mr-0.5 h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                </template>

                <template #content>
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        Manage Account
                    </div>

                    <JetDropdownLink :href="route('profile.show')">
                        Profile
                    </JetDropdownLink>

                    <JetDropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                        API Tokens
                    </JetDropdownLink>

                    <div class="border-t border-gray-100" />

                    <!-- Authentication -->
                    <form @submit.prevent="logout">
                        <JetDropdownLink as="button">
                            Log Out
                        </JetDropdownLink>
                    </form>
                </template>
            </JetDropdown>
        </template>

        <!-- Page Heading -->
        <template v-if="$slots.header" #heading>
            <header  class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>
        </template>

        <template #responsive-links>
            <ResponsiveLinks @logout="logout">
                <slot name="sidebar" />
            </ResponsiveLinks>
        </template>
        <slot />
    </BaseLayout>
</template>
