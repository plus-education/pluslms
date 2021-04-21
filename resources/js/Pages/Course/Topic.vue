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

                        <video-activity v-if="activity.type == 'VIDEO'" :activity="activity" :user="user"></video-activity>

                    </div>
                </div>

                <div class="flex-shrink w-2/12 bg-white shadow-lg border border-gray-200 h-screen overflow-y-scroll">
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
                             v-show="activity.isShow == 1"
                             class="flex items-center  border-b-2 border-gray-100 cursor-pointer"
                             @click="changeActivity(activity)"
                        >
                            <div v-if="activity.type == 'DIVIDER'" class="flex bg-yellow-300 w-full h-full py-4 px-2">
                                <div class="flex-shrink mr-2" v-html="icons[activity.type]"></div>
                                <div class="flex-1 text-lg font-bold text-gray-800" >
                                    {{ activity.name }}
                                </div>
                            </div>

                            <div v-else class="flex w-full h-full py-4 px-2" >
                                <div class="flex-shrink mr-2" v-html="icons[activity.type]">

                                </div>
                                <div class="flex-1 text-gray-800">
                                    {{ activity.name }}
                                </div>
                            </div>
                        </div>


                        <a class="flex w-full h-full py-4 px-2 bg-green-500" :href="`/courseGradebook/${topic.id}`" >
                            <div class="flex-shrink mr-2">
                                <svg  xmlns="http://www.w3.org/2000/svg" class="h-6 w-6  text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                </svg>
                            </div>
                            <div class="flex-1 text-white font-extrabold">
                                Punteo Acumulada
                            </div>
                        </a>
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
    import VideoActivity from "./Activities/Video";
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
            VideoActivity,
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
            this.setDivider()
        },

        mounted() {
            this.icons = sidebarIcons
        },

        methods: {
            initializeActivity: function() {
                return (this.topic.activities.length > 0) ? this.activity = this.topic.activities[0] : false
            },

            setDivider: function() {
                let divider = 0

                this.topic.activities.forEach(activity => {
                    if(activity.type == 'DIVIDER'){
                        divider = activity.id
                        activity.show = true
                        return
                    }

                    activity.divider = divider;
                    //activity.show = divider == 0 ? true : false;
                    activity.show = true
                    return activity
                })
            },

            changeActivity: function(selectedActivity) {

                this.selectNewActivity(selectedActivity)
                //this.showDividerActivities(selectedActivity)
            },

            selectNewActivity: function(selectedActivity) {
                this.activity = this.topic.activities.find( (activity) => {
                    return activity.id == selectedActivity.id
                })
            },

            showDividerActivities: function(divider) {
                return divider.show = true


                if(divider.type != 'DIVIDER'){
                    return false;
                }

                this.topic.activities.forEach(activity => {
                    if(activity.divider != divider.id && activity.divider != 0){
                        activity.show = false
                        return
                    }

                    activity.show = true
                    return activity
                })

            },
        }
    }
</script>

<style scoped>

</style>
