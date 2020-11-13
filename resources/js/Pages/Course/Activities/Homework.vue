<template>
    <div>
        <div class="mt-4">
            {{ activity.activityable.description }}
        </div>

        <div class="flex items-center justify-center mt-8 w-full">
            <a
                v-if="activity.activityable.file != null"
                class="bg-blue-100 px-6 py-4 shadow rounded-lg font-bold"
                :href="`/storage/${activity.activityable.path}`"
                target="_blank"
            >Descargar Documento Adjunto</a>
        </div>

        <comments :activity="activity" :user="user"></comments>
    </div>
</template>

<script>
    import Comments from "../Comments";

    export default {
        components: {
            Comments,
        },

        props: {
            activity: Object,
            user: Object,
        }
    }
</script>

<style scoped>

</style>
