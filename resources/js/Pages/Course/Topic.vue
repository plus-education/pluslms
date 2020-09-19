<template>
    <div>
        <div class="" >
            <div class="flex h-screen">
                <div class=" bg-gray-100 flex-1 p-8 max-h-full">
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
                    <header class="bg-cover text-white py-2"  :style="`background-image: url('${topic.course.coverPath}')`">
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
                            <div class="flex-shrink mr-2" v-html="icons[activity.type]">

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
    import sidebarIcons from './SidebarIcons.js'
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
              activity: Object,
              icons: Object
          }
        },

        created() {
            this.activity = this.initializeActivity()
        },

        mounted() {
            this.icons = sidebarIcons
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
