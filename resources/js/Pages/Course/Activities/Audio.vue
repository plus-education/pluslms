<template>
    <div class="">
        <div class="activity-header flex items-center">
            <div class="flex-1">
                <h1 class="text-2xl text-gray-800">
                    {{ activity.name }}
                </h1>
            </div>
        </div>

        <div class="p-4 text-center flex align-content-center">
            <div>
                <audio controls preload="auto"  controlsList="nodownload">
                    <source :src="`/storage/${activity.activityable.path}`" type="audio/mpeg">
                    Your browser does not support the <code>audio</code> element.
                </audio>
            </div>
        </div>


        <comments :activity="activity" :user="user"></comments>
    </div>
</template>

<script>
import Comments from "../Comments";
import AudioVisual from 'vue-audio-visual'

export default {
    components: {
        Comments,
        AudioVisual
    },

    props: {
        activity: Object,
        user: Object,
    },
}
</script>

<style scoped>

</style>
