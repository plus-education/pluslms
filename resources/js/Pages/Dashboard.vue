<template>
    <app-layout>
        <template #header>
           <ul>
               <li>Home</li>
           </ul>
        </template>

        <section>
            <div class="container m-auto mt-6 mb-6 flex flex-col md:flex-row items-center justify-between bg-white shadow-lg">
                <div class="flex-1 card  p-6   mr-4">
                    <div class="w-full">
                       <div class="w-24 m-auto">
                           <img
                               class="w-24 h-24 rounded-full mb-6"
                               :src="$page.user.profile_photo_url"
                               alt=""
                           >
                       </div>
                    </div>
                    <div>
                        <h3 class="text-center font-bold text-lg text-gray-700">
                            {{ $page.user.name}}
                        </h3>
                        <div class="text-center  text-gray-500">
                            <strong>Code: </strong> {{ $page.user.code}}
                        </div>
                    </div>
                </div>

                <div class="flex-1  card  p-6   ml-4  md:border-l">
                    <div v-if="group !== null && group.zoom !== null" class="text-center">
                        <a :href="group.zoom" class="btn bg-green-500 p-4 text-white m-4 rounded-lg">
                            Join Group Zoom
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="container m-auto">
           <div v-if="group != null">
               <div class="mb-4">
                   <div v-html="group.html"></div>
               </div>
           </div>

            <home :courses="courses"></home>
        </section>

    </app-layout>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'
    import Home from './home'

    export default {
        components: {
            AppLayout,
            Home,
        },

        props: {
            courses: Array,
            group: Object,
        },
    }
</script>
