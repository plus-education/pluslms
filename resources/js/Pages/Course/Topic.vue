<template>
    <div>
        <div class="" >
            <div class="flex h-screen">
                <div class=" bg-gray-100 flex-1 p-8 h-full">
                    <div v-if="!activity">
                        <h1 class="text-2xl text-gray-800">
                            Aun no cuentas con actividades
                        </h1>
                        <hr>
                    </div>

                    <div v-else class="h-full container m-auto bg-white shadow rounded-lg p-4">

                        <file-activity v-if="activity.type == 'FILE'" :activity="activity"></file-activity>

                        <link-activity v-if="activity.type == 'LINK'" :activity="activity"></link-activity>

                        <text-activity v-if="activity.type == 'TEXT'" :activity="activity"></text-activity>

                        <pdf-activity v-if="activity.type == 'PDF'" :activity="activity"></pdf-activity>

                    </div>


                </div>

                <div class="flex-shrink w-2/12 bg-white shadow-lg border border-gray-200 h-screen">
                    <header class="bg-cover text-white py-2"  style="background-image: url('/img/courses/cover1.jpg')">
                        <inertia-link  :href="`/courses/${ topic.course.id}`">
                            <h1 class="text-xl text-white text-center font-bold">{{ topic.course.name }}</h1>
                        </inertia-link>
                    </header>

                    <section class="bg-gray-100 py-2 border-t">
                        <h1 class="text-lg  text-gray-800 text-center">
                            {{ topic.name }}
                        </h1>
                    </section>

                    <section class="">
                        <div v-for="activity in topic.activities"
                             :key="activity.id"
                             class="flex items-center py-6 px-2 border-b-2 border-gray-100 cursor-pointer"
                             @click="changeActivity(activity.id)"
                        >
                            <div class="flex-shrink mr-2">
                                <svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="flex-1 text-lg text-gray-800">
                                {{ activity.name }}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import FileActivity from './Activities/File'
    import LinkActivity from './Activities/Link'
    import TextActivity from './Activities/Text'
    import PdfActivity from "./Activities/Pdf";

    export default {
        components: {
            AppLayout,
            FileActivity,
            LinkActivity,
            TextActivity,
            PdfActivity
        },

        props: {
            topic: Object,
        },

        data: () => {
          return {
              activity: Object
          }
        },

        created() {
            this.activity = this.initializeActivity()
        },

        methods: {
            initializeActivity: function()
            {
                return (this.topic.activities.length > 0) ? this.activity = this.topic.activities[0] : false
            },

            changeActivity: function(id) {
                this.activity = this.topic.activities.find( (activity) => {
                    return activity.id == id
                })
            }
        }
    }
</script>

<style scoped>

</style>
