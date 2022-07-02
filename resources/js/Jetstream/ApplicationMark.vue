<template>
    <img v-if="url !== null" :src="url" />
    <p v-else class="p-2 text-xl">Tūmata</p>
</template>

<script>
export default {
        data: () => {
            return {
                url: null,
            }
        },
        mounted() {
            this.getLogo();
        },
        methods: {
            getLogo() {
                axios.get(route('logo')).then(response => {
                    if (response.data && response.data.url !== null) {
                        this.url = response.data.url;
                    }
                });
            }
        }
    }
</script>
