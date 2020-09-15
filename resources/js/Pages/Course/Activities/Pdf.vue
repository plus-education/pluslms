<template>
    <div class="h-full overflow-scroll">
        <div>
            <h1 class="text-2xl text-gray-800">
                {{ activity.name }}
            </h1>
            <hr>
        </div>

        <div>
            <pdf
                v-for="i in numPages"
                :key="i"
                :src="src"
                :page="i"
                class="w-full"
            ></pdf>
        </div>
    </div>
</template>

<script>
    import pdf from 'vue-pdf'


    export default {
        components: {
            pdf
        },

        data() {
            return {
                src: Object,
                numPages: undefined,
            }
        },

        props: {
            activity: Object
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
