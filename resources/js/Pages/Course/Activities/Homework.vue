<template>
    <div>
        <h1 class="text-2xl text-gray-800">
            {{ activity.name }}
        </h1>
        <hr>

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
    </div>
</template>

<script>
    export default {
        props: {
            activity: Object
        }
    }
</script>

<style scoped>

</style>
