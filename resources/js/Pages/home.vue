<template>
       <div>
           <h1 class="text-lg mt-6 mb-4 text-gray-800">Mis cursos</h1>

           <section class="mb-4">
               <input type="text" class="w-full focus:no-underline py-2 px-4 shadow rounded-lg" placeholder="Buscar">
           </section>

           <section class="grid  lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1">
               <inertia-link v-for="course in courses"  :key="course.id"  :href="`/courses/${course.id}`">
                   <div class="p-2  w-full lg:max-w-full lg:flex">
                       <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('https://picsum.photos/300')" title="Woman holding a mug">
                       </div>
                       <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                           <div class="mb-8">
                               <p class="text-sm text-orange-500 flex items-center">
                                   <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                       <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
                                   </svg>
                                   {{ course.group}}
                                   1
                               </p>
                               <div class="text-gray-900 font-bold text-xl mb-2">
                                   {{ course.name }}
                                   <p class="text-gray-700 text-sm">
                                       {{ course.code }}
                                   </p>

                               </div>
                           </div>
                       </div>
                   </div>
               </inertia-link>
           </section>
       </div>
</template>

<script>
    export default {
        components: {
        },

        props: {
            courses: Object,
        },
    }
</script>

<style scoped>

</style>
