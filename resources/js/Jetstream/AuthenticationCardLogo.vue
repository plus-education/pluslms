<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import ApplicationMark from '@/Jetstream/ApplicationMark';
</script>

<template>
    <Link :href="'/'">
        <div class="w-full sm:max-w-md mt-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <ApplicationMark />
        </div>
    </Link>
</template>
