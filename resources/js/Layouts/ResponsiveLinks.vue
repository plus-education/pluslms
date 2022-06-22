<script setup>
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue';
</script>

<template>
    <div class="pt-2 pb-3 space-y-1">
        <JetResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
            Dashboard
        </JetResponsiveNavLink>
    </div>

    <!-- Responsive Settings Options -->
    <div class="pt-4 pb-1 border-t border-gray-200">
        <div class="flex items-center px-4">
            <div v-if="$page.props.jetstream?.managesProfilePhotos" class="shrink-0 mr-3">
                <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name">
            </div>

            <div>
                <div class="font-medium text-base text-gray-800">
                    {{ $page.props.user.name }}
                </div>
                <div class="font-medium text-sm text-gray-500">
                    {{ $page.props.user.email }}
                </div>
            </div>
        </div>

        <div class="mt-3 space-y-1">
            <JetResponsiveNavLink :href="route('profile.show')" :active="route().current('profile.show')">
                Profile
            </JetResponsiveNavLink>

            <JetResponsiveNavLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')" :active="route().current('api-tokens.index')">
                API Tokens
            </JetResponsiveNavLink>

            <!-- Authentication -->
            <form method="POST" @submit.prevent="$emit('logout')">
                <JetResponsiveNavLink as="button">
                    Log Out
                </JetResponsiveNavLink>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    emits: ['logout']
}
</script>
