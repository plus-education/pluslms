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
    import $ from 'jquery';
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
            var iframe = document.getElementById('h5p-content');
            var iframeWin = iframe.contentWindow || iframe;
            var iframeDoc = iframe.contentDocument || iframeWin.document;
            window.frameDoc = iframeDoc;

            /*$(iframeDoc).ready(function (event) {
                iframeDoc.open();
                iframeDoc.write(`\<script>
                    console.log(this);
                    H5P.externalDispatcher.on('xAPI', function (event) {
                        window.parent.postMessage(event.data.statement, '*');
                    });
                \<\/script>`);
                iframeDoc.close();
            });*/
        },
    }
</script>

<style scoped>

</style>
