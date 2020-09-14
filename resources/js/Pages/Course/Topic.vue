<template>
    <div>
        <div class="" >
            <div class="flex h-screen">
                <div class=" bg-gray-100 flex-1 p-8 h-full">
                    <div class="h-full container m-auto bg-white shadow rounded-lg p-4">
                        <h1 class="text-2xl text-gray-800">
                            {{ activity.name }}
                        </h1>
                        <hr>

                        <div class="mt-4">
                            {{ activity.activityable.body }}
                        </div>
                    </div>
                </div>

                <div class="flex-shrink w-2/12 bg-white shadow-lg border border-gray-200 h-screen">
                    <header class="bg-orange-500 text-white py-2">
                        <inertia-link  :href="`/courses/${ topic.course.id}`">
                            <h1 class="text-xl text-white text-center">{{ topic.course.name }}</h1>
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

    export default {
        components: {
            AppLayout,
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
           this.activity = this.topic.activities[0]
        },

        methods: {
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
