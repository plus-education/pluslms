<template>
    <div>
        <!--Sidebar with Dimmer -->
        <div class="fixed inset-0 flex z-40"
            :class="[open ? 'w-full' : 'w-12']"
        >
            <!-- Sidebar -->
            <div
                class="absolute flex top-0 h-screen z-20"
                :class="[right ? 'right-0 flex-row' : 'left-0 flex-row-reverse']"
            >
                <!--Drawer -->
                <button
                    @click.prevent="toggle()"
                    class="pulse p-1 my-auto rounded text-white bg-green-600 text-center focus:outline-none hover:bg-gray-500 transition-color duration-300"
                >
                    <svg v-if="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                    </svg>
                </button>

                <!-- Sidebar Content -->
                <div
                    ref="content"
                    class="transition-all duration-700 overflow-y-scroll bg-white overflow-hidden flex items-top"
                    :class="[open ? 'block' : 'hidden']"
                >

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

                            <div v-else class="flex w-full h-full py-4 px-2" :class="activity.activeClass">
                                <div class="flex-shrink mr-2" v-html="icons[activity.type]">

                                </div>
                                <div class="flex-1 text-gray-800">
                                    {{ activity.name }}
                                </div>
                            </div>
                        </div>


                        <a class="flex w-full py-4 px-2 bg-green-500" :href="`/courseGradebook/${topic.id}`" >
                            <div class="flex-shrink mr-2">
                                <svg  xmlns="http://www.w3.org/2000/svg" class="h-6 w-6  text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                </svg>
                            </div>
                            <div class="flex-1 text-white font-extrabold">
                                Punteo Acumulado
                            </div>
                        </a>
                    </section>


                </div>
            </div>

            <transition name="fade">
                <!-- Dimmer -->
                <div
                    v-if="dimmer && open"
                    @click="toggle()"
                    class="flex-1 bg-gray-400 bg-opacity-75 active:outline-none z-10"
                />
            </transition>
        </div>

        <!-- Page Content -->
        <div
            class="absolute inset-1/2 rounded w-screen h-screen transform -translate-x-1/2 -translate-y-1/2 -translate-x-1/2 -translate-y-1/2 flex justify-center"
        >

            <div class="p-8 flex-1  max-h-full">
                <nav
                    class="block text-sm text-left text-gray-600 bg-gray-100 shadow  bg-opacity-10 h-12 flex items-center p-4 rounded-md container m-auto  mb-6 "
                    role="alert"
                >
                    <ol class="list-reset flex text-grey-dark">
                        <li>
                            <inertia-link href="/dashboard" class="font-bold">Inicio</inertia-link>
                        </li>
                        <li><span class="mx-2">/</span></li>
                        <li>
                            <inertia-link :href="`/courses/${topic.course.id}`" class="font-bold">{{ topic.course.name }}</inertia-link>
                        </li>
                        <li><span class="mx-2">/</span></li>
                        <li>
                            {{ topic.name }}
                        </li>
                    </ol>
                </nav>

                <div v-if="!activity">
                    <h1 class="text-2xl text-gray-800">
                        Aun no cuentas con actividades
                    </h1>
                    <hr>
                </div>

                <div v-else class=" pb-4 mb-8 container m-auto  bg-white shadow rounded-lg overflow-scroll">

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
              open: false,
              dimmer: true,
              right: false,
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
            toggle() {
                this.open = !this.open;
            },

            initializeActivity: function() {
                return (this.topic.activities.length > 0) ? this.activity = this.topic.activities[0] : false
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

                this.selectNewActivity(selectedActivity)
                //this.showDividerActivities(selectedActivity)
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
