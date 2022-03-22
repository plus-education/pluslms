<template>
    <div class="h-full overflow-scroll">
        <div class="activity-header flex items-center">
            <div class="flex-1">
                <h1 class="text-2xl text-gray-800">
                    {{ activity.name }}
                </h1>
            </div>
        </div>
        <div class="">

        </div>

        <div v-if="src != false">
            <pdf
                v-for="i in numPages"
                :key="i"
                :src="src"
                :page="i"
                class="w-full shadow-lg border"
            ></pdf>
        </div>

        <comments :activity="activity" :user="user"></comments>
    </div>
</template>

<script>
    import pdf from 'vue-pdf'
    import Comments from "../Comments";


    export default {
        components: {
            pdf,
            Comments
        },

        data() {
            return {
                src: false,
                numPages: undefined,
                isLoaded: false
            }
        },

        props: {
            activity: Object,
            user: Object,
        },

        watch: {
            activity: function () {
                this.src = false

                setTimeout(() => {
                    this.src  = pdf.createLoadingTask(`/storage/${this.activity.activityable.path}`);

                    this.src.promise.then(pdf => {

                        this.numPages = pdf.numPages;
                    });
                }, 500);
            }
        },

        mounted() {
            this.src  = pdf.createLoadingTask(`/storage/${this.activity.activityable.path}`);

            this.src.promise.then(pdf => {

                this.numPages = pdf.numPages;
            });
        },

        destroyed() {
            console.log('XD me esto destrullendo')
        }
    }
</script>

<style scoped>

</style>
