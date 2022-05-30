<script setup>
import AppWithSidebarLayout from '@/Layouts/AppWithSidebarLayout.vue';
import { CButton } from '@coreui/vue'
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
    <AppWithSidebarLayout 
        :title="title" 
        :topic="topic" 
        :topics="topics"
        :fullHeight="true"
        :icons="icons"
        @change-activity="changeActivity"
    >
        <div class="max-w-7xl mx-auto md:px-6 lg:px-8">
            <div class="md:p-4 bg-white shadow-xl sm:rounded-lg">

                <div v-if="!activity">
                    <h1 class="text-2xl text-gray-800">
                        You don't have activities yet
                    </h1>
                    <hr>
                </div>

                <div v-else class="pb-4 mb-8 container m-auto bg-white shadow rounded-lg"><!-- overflow-scroll">-->

                    <divider-activity v-if="activity.type == 'DIVIDER'" :activity="activity" :user="user"></divider-activity>

                    <exercise-activity v-if="activity.type == 'EXERCISE'" :activity="activity" :user="user"></exercise-activity>

                    <file-activity v-if="activity.type == 'FILE'" :activity="activity" :user="user"></file-activity>

                    <h5p-activity v-if="activity.type == 'H5P'" :activity="activity" :user="user" />

                    <link-activity v-if="activity.type == 'LINK'" :activity="activity" :user="user"></link-activity>

                    <make-code-activity v-if="activity.type == 'MAKECODE'" :activity="activity" :user="user" />

                    <text-activity v-if="activity.type == 'TEXT'" :activity="activity" :user="user"></text-activity>

                    <pdf-activity v-if="activity.type == 'PDF'" :activity="activity" :user="user"></pdf-activity>

                    <homework-activity v-if="activity.type == 'HOMEWORK'" :activity="activity" :user="user"></homework-activity>

                    <youtube-activity v-if="activity.type == 'YOUTUBE'" :activity="activity" :user="user"></youtube-activity>

                    <video-activity v-if="activity.type == 'VIDEO'" :activity="activity" :user="user"></video-activity>

                </div>


                <div class="flex justify-between">
                    <Link class="btn btn-outline-info" :href="prev_url" v-if="prev_url">Prev</Link>
                    <div v-else></div>

                    <!--<form 
                        class="pl-2" 
                        @submit.prevent="finish_task(course.slug, section.id, topic.id)" 
                        v-if="next_url"
                    >
                        <CButton color="info" variant="outline" type="submit">Next</CButton>
                    </form>-->
                    <Link class="btn btn-outline-info" :href="next_url" v-if="next_url">Next</Link>
                    <div v-else></div>
                </div>
            </div>
        </div>
    </AppWithSidebarLayout>
</template>

<script>
    import sidebarIcons from './SidebarIcons.js'

    import DividerActivity from "./Activities/Divider"
    import ExerciseActivity from "./Activities/Exercise"
    import FileActivity from './Activities/File'
    import H5pActivity from './Activities/H5p';
    import LinkActivity from './Activities/Link';
    import MakeCodeActivity from './Activities/MakeCode';
    import TextActivity from './Activities/Text'
    import PdfActivity from "./Activities/Pdf"
    import HomeworkActivity from "./Activities/Homework";
    import YoutubeActivity from "./Activities/Youtube";
    import VideoActivity from "./Activities/Video";
    import Comments from "./Comments";

    export default {
        components: {
            FileActivity,
            H5pActivity,
            DividerActivity,
            ExerciseActivity,
            HomeworkActivity,
            LinkActivity,
            MakeCodeActivity,
            TextActivity,
            PdfActivity,
            YoutubeActivity,
            VideoActivity,
            Comments,
        },

        props: {
            topic: Object,
            topics: Object,
            user: Object,
            activityid: Number,
        },

        data: () => {
          return {
              open: false,
              dimmer: true,
              right: false,
              activity: Object,
              icons: Object,
              prev_url: null,
              next_url: null,
          }
        },

        created() {
            this.activity = this.initializeActivity()

            if (this.activity) {
                this.activity.activeClass = 'active-activity'
            }
            this.setDivider()
        },

        mounted() {
            this.icons = sidebarIcons;
            this.getNav();
        },

        methods: {
            toggle() {
                this.open = !this.open;
            },

            getNav: function() {
                if (!this.activity.id) return;
                
                axios.get(route('nav.topic.activity', this.activity.id)).then(response => {
                    console.log(response.data);

                    if (response.data.prev != null) {
                        this.prev_url = route('courses.topic', [response.data.prev?.topic_id ?? this.topic.id, response.data.prev.id]);
                    }

                    if (response.data.next != null) {
                        this.next_url = route('courses.topic', [response.data.next?.topic_id ?? this.topic.id, response.data.next.id]);
                    }
                    //this.comments = response.data
                })
            },

            initializeActivity: function() {
                let index = 0;

                if (this.activityid) {
                    let key = window._.findKey(this.topic.activities, obj => {
                        return obj.id == this.activityid
                    });

                    if (key) index = key;
                }

                return (this.topic.activities.length > 0) ? this.activity = this.topic.activities[index] : false
            },

            setDivider: function() {
                let divider = 0

                this.topic.activities.forEach(activity => {
                    if(activity.type == 'DIVIDER'){
                        divider = activity.id
                        activity.show = true
                        activity.activeClass = null
                        return
                    }

                    activity.divider = divider;
                    //activity.show = divider == 0 ? true : false;
                    activity.show = true
                    return activity
                })
            },

            changeActivity: function(selectedActivity) {
                this.selectNewActivity(selectedActivity);
                this.getNav(this.activity);
            },

            selectNewActivity: function(selectedActivity) {
                this.topic.activities.forEach( (activity) => {
                    if (activity.id == selectedActivity.id) {
                        activity.activeClass = 'active-activity'
                        return this.activity = activity
                    }

                    return activity.activeClass = null
                })
            },
        }
    }
</script>

<style>

html {
    background: #efefef;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 1s ease-out;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}
.pulse {
    background: rgba(51, 217, 178, 1);
    box-shadow: 0 0 0 0 rgba(51, 217, 178, 1);
    animation: pulse-green 2s infinite;
}

@keyframes pulse-green {
    0% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(51, 217, 178, 0.7);
    }

    70% {
        transform: scale(1);
        box-shadow: 0 0 0 10px rgba(51, 217, 178, 0);
    }

    100% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(51, 217, 178, 0);
    }
}

.active-activity {
    background-color: #F4F5F7;
    border-bottom: #0d826c solid 2px;
}

.active-activity{
    color:#0d826c;
    font-weight: bold;
}

.active-activity svg{
    color: #0d826c;
}
</style>
