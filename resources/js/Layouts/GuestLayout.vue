<script setup>
    import BaseLayout from '@/Layouts/BaseLayout.vue';
    import JetNavLink from '@/Jetstream/NavLink.vue';
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue';

defineProps({
    title: String,
});
</script>

<template>
    <BaseLayout :title="title">
        <template #links-right>
            <JetNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                Student
            </JetNavLink>
            <JetNavLink :href="route('nova.pages.home')">
                Teacher
            </JetNavLink>
        </template>
        <template #responsive-links>
            <div class="pt-2 pb-3 space-y-1">
                <JetResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                    Student
                </JetResponsiveNavLink>
                <JetResponsiveNavLink :href="route('nova.pages.home')">
                    Teacher
                </JetResponsiveNavLink>
            </div>
        </template>

        <slot />
    </BaseLayout>
</template>