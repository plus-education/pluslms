<template>
    <app-layout>
        <template #header>
            <ul class="list-reset flex text-grey-dark">
                <li>
                    <a href="/dashboard">Inicio</a>
                </li>

                <li><span class="mx-2">/</span></li>

                <li >
                    <inertia-link :href="`/courses/${topic.course.id}`">
                        {{ topic.course.name }}
                    </inertia-link>
                </li>

                <li><span class="mx-2">/</span></li>

                <li>
                    <inertia-link :href="`/courses/topicHome/${topic.id}`">{{ topic.name }}</inertia-link>
                </li>

                <li><span class="mx-2">/</span></li>

                <li class="font-bold">Tareas</li>

            </ul>
        </template>

        <section class="container m-auto mt-6  md:px-0 sm:px-4">
                <div class="mb-6" v-for="homework in homeworks" :key="homeworks.id">
                    <div class="flex justify-between items-center shadow-xl  bg-white ">
                        <div class="p-4 h-full">
                            <h3 class="font-bold">
                                {{ homework.name }}
                            </h3>
                        </div>

                        <div class="p-4">
                            <div class="text-xs text-blue-500 font-bold">Fecha de entrega</div>
                            <div class="text-xs">
                                <strong>Del:</strong> {{ homework.start }}
                            </div>
                            <div class="text-xs">
                                <strong>Al:</strong> {{ homework.end }}
                            </div>
                        </div>

                        <div class="p-4">

                            <strong>Punteo:</strong> {{ homework.score }}
                        </div>
                        <div class="p-4">
                            <inertia-link :href="`/courses/homeworks/show/${homework.id}`" title="Ver tarea" class="">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </inertia-link>
                        </div>
                    </div>
                </div>
        </section>
    </app-layout>
</template>

<script>
import AppLayout from './../../Layouts/AppLayout'

export default {
    components: {
        AppLayout,
    },

    props: {
        topic: Object,
        homeworks: Object,
    }
}
</script>
