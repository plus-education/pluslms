<template>
    <div>
        <h1 class="text-2xl text-gray-800">
            {{ activity.name }}
        </h1>
        <hr>

        <div class="mt-4">
            <iframe
                class="m-auto"
                type="text/html" width="640" height="360"
                    :src="`https://www.youtube.com/embed/${activity.activityable.video}`"
                    frameborder="0">
            </iframe>
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
