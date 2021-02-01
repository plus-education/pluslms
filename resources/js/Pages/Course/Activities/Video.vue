<template>
    <div>
        <div class="mt-4">
            <video width="640" height="360" controls>
                <source :src="`/storage/${activity.activityable.path}`" type="video/mp4">
            </video>
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
