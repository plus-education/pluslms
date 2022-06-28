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
        :activity="activity"
        :fullHeight="true"
        :icons="icons"
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

                    <exercise-activity v-if="activity.type == 'EXERCISE'" :activity="activity" :user="user"></exercise-activity>

                    <h5p-activity v-if="activity.type == 'H5P'" :activity="activity" :user="user" />

                    <make-code-activity v-if="activity.type == 'MAKECODE'" :activity="activity" :user="user" />

                    <text-activity v-if="activity.type == 'TEXT'" :activity="activity" :user="user"></text-activity>

                </div>


                <div class="flex justify-between">
                    <Link class="btn-outline-primary" :href="prev_url" v-if="prev_url">&lt; Prev</Link>
                    <div v-else></div>

                    <Link class="btn-outline-primary" :href="next_url" v-if="next_url">Next &gt;</Link>
                    <div v-else></div>
                </div>
            </div>
        </div>
    </AppWithSidebarLayout>
</template>

<script>
    import sidebarIcons from './SidebarIcons.js'

    import ExerciseActivity from "./Activities/Exercise"
    import H5pActivity from './Activities/H5p';
    import MakeCodeActivity from './Activities/MakeCode';
    import TextActivity from './Activities/Text'
    import Comments from "./Comments";

    export default {
        components: {
            H5pActivity,
            ExerciseActivity,
            MakeCodeActivity,
            TextActivity,
            Comments,
        },

        props: {
            topic: Object,
            topics: Object,
            activity: Object,
            user: Object,
        },

        data: () => {
          return {
              open: false,
              dimmer: true,
              right: false,
              icons: Object,
              prev_url: null,
              next_url: null,
          }
        },

        created() {
            /*if (this.activity) {
                this.activity.activeClass = 'active-activity'
            }*/
        },

        mounted() {
            this.icons = sidebarIcons;
            this.getNav();

            /*window.addEventListener('message', function receiveMessage(event) {
                if (event.data.result === undefined) {
                    return; // Only handle messages with result
                }

                console.log(event.data.actor.name + ' just scored ' + (event.data.result.score.scaled * 100) + ' %');
                } , false);*/
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
