<template>
    <div class="h-full overflow-scroll">
        <div class="">
            <a :href="`/storage/${this.activity.activityable.path}`"   download target="_blank" class="btn btn-primary bg-green-500 text-white px-4 py-2 shadow-lg flex">
                <div class="flex items-center align-middle w-auto m-auto">
                    <div class="flex-shrink">
                        <svg class="text-white w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                    </div>
                    <div class="ml-2">
                        Descargar documento
                    </div>
                </div>
            </a>
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
            }
        },

        props: {
            activity: Object,
            user: Object,
        },

        beforeCreate() {
        },

        mounted() {
            this.src = false

            this.src  = pdf.createLoadingTask(`/storage/${this.activity.activityable.path}`);

            this.src.promise.then(pdf => {

                this.numPages = pdf.numPages;
            });
        },

        updated() {
            this.src  = pdf.createLoadingTask(`/storage/${this.activity.activityable.path}`);

            this.src.promise.then(pdf => {

                this.numPages = pdf.numPages;
            });
        }
    }
</script>

<style scoped>

</style>
