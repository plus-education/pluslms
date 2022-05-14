<template>
    <div>
        <div class="activity-header flex items-center">
            <div class="flex-1">
                <h1 class="text-2xl text-gray-800">
                    {{ activity.name }}
                </h1>
            </div>
        </div>

        <div class="mt-4">
            <iframe
                id="h5p-content"
                class="m-auto w-full"
                type="text/html"
                    :src="activity.activityable.link"
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
        },

        mounted() {
            this.resizeH5PContent();
            window.addEventListener("resize", this.resizeH5PContent);
        },

        methods: {
            resizeH5PContent(e = null) {
                let iFrame = document.getElementById('h5p-content');
                console.log(iFrame);
                iFrame.height = iFrame.contentWindow.document.body.scrollHeight;

                //document.getElementById("h5p-content").style.height = document.getElementById("h5p-content").contentWindow.document.body.scrollHeight + "px";
            }
        }
    }
</script>

<style scoped>

</style>
