<template>
    <img v-if="url !== null" :src="url" />
    <p v-else class="p-2 text-xl">{{ title }}</p>
</template>

<script>
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'

export default {
        setup() {
            const url = computed(() => usePage().props.value.settings.logo);
            const title = computed(() => usePage().props.value.settings.title);
            console.log(url);
            return { url, title }
        }
    }
</script>
