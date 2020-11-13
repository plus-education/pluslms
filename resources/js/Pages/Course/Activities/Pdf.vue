<template>
    <div class="h-full overflow-scroll">
        <div>
            <pdf
                v-for="i in numPages"
                :key="i"
                :src="src"
                :page="i"
                class="w-full"
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
                src: Object,
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
        this.src  = pdf.createLoadingTask(`/storage/${this.activity.activityable.path}`);

        this.src.promise.then(pdf => {

                this.numPages = pdf.numPages;
            });
        }

    }
</script>

<style scoped>

</style>
