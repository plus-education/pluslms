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

                <li>{{ topic.name }}</li>
            </ul>
        </template>

        <section class="container m-auto mt-6  md:px-0 sm:px-4">
            <div class="flex justify-center">
                <inertia-link class="bg-white shadow-lg" :href="`/courses/topic/${topic.id}`">
                    <div>
                        <img src="/img/homework.jpg" alt="">
                    </div>
                    <div class="text-center p-4 bg-orange-500">
                        <h2 class="text-2xl text-white font-bold">Contenido académico</h2>
                    </div>
                </inertia-link>

                <inertia-link class="bg-white shadow-lg ml-6" :href="`/courses/homeworks/${topic.id}`">
                    <div>
                        <img src="/img/book.jpg" alt="">
                    </div>
                    <div class="text-center p-4 bg-green-500">
                        <h2 class="text-2xl text-white font-bold">Tareas</h2>
                    </div>
                </inertia-link>
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
        topic: Object
    }
}
</script>

<style scoped>

</style>
