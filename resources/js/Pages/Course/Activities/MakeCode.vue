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
                    
                    frameborder="0">
            </iframe>
            <div style="position:relative;height:calc(300px + 5em);width:100%;overflow:hidden;">
                <iframe 
                    style="position:absolute;top:0;left:0;width:100%;height:100%;" 
                    :src="activity.activityable.link" 
                    allowfullscreen="allowfullscreen" 
                    frameborder="0" 
                    sandbox="allow-scripts allow-same-origin"
                ></iframe>
            </div>
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
    }
</script>

<style scoped>

</style>
