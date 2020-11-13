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

                    <div v-else class="h-full container m-auto bg-white shadow rounded-lg p-4 overflow-scroll">
                        <div class="flex items-center">
                            <div class="flex-shrink mr-2" v-html="icons[activity.type]"></div>

                           <div class="flex-1">
                               <h1 class="text-2xl text-gray-800">
                                   {{ activity.name }}
                               </h1>
                           </div>
                        </div>

                        <hr>

                        <divider-activity v-if="activity.type == 'DIVIDER'" :activity="activity" :user="user"></divider-activity>

                        <exercise-activity v-if="activity.type == 'EXERCISE'" :activity="activity" :user="user"></exercise-activity>

                        <file-activity v-if="activity.type == 'FILE'" :activity="activity" :user="user"></file-activity>

                        <link-activity v-if="activity.type == 'LINK'" :activity="activity" :user="user"></link-activity>

                        <text-activity v-if="activity.type == 'TEXT'" :activity="activity" :user="user"></text-activity>

                        <pdf-activity v-if="activity.type == 'PDF'" :activity="activity" :user="user"></pdf-activity>

                        <homework-activity v-if="activity.type == 'HOMEWORK'" :activity="activity" :user="user"></homework-activity>

                        <youtube-activity v-if="activity.type == 'YOUTUBE'" :activity="activity" :user="user"></youtube-activity>
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
                             class="flex items-center  border-b-2 border-gray-100 cursor-pointer"
                             @click="changeActivity(activity.id)"
                        >
                            <div v-if="activity.type == 'DIVIDER'" class="flex bg-yellow-300 w-full h-full py-4 px-2">
                                <div class="flex-shrink mr-2" v-html="icons[activity.type]"></div>
                                <div class="flex-1 text-lg font-bold text-gray-800">
                                    {{ activity.name }}
                                </div>
                            </div>

                            <div v-else class="flex w-full h-full py-4 px-2">
                                <div class="flex-shrink mr-2" v-html="icons[activity.type]">

                                </div>
                                <div class="flex-1 text-gray-800">
                                    {{ activity.name }}
                                </div>
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

    import DividerActivity from "./Activities/Divider"
    import ExerciseActivity from "./Activities/Exercise"
    import FileActivity from './Activities/File'
    import LinkActivity from './Activities/Link'
    import TextActivity from './Activities/Text'
    import PdfActivity from "./Activities/Pdf"
    import HomeworkActivity from "./Activities/Homework";
    import YoutubeActivity from "./Activities/Youtube";

    import Comments from "./Comments";

    export default {
        components: {
            AppLayout,
            FileActivity,
            DividerActivity,
            ExerciseActivity,
            HomeworkActivity,
            LinkActivity,
            TextActivity,
            PdfActivity,
            YoutubeActivity,
            Comments,
        },

        props: {
            topic: Object,
            user: Object
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
            initializeActivity: function() {
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
