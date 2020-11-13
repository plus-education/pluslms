<template>
    <div>
        <div class="mt-4">
            <iframe
                class="m-auto"
                type="text/html" width="640" height="360"
                    :src="`https://www.youtube.com/embed/${activity.activityable.video}`"
                    frameborder="0">
            </iframe>
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
