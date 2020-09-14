<template>
    <app-layout>
        <template #header>
            <ul>
                <li>Inicio</li>
            </ul>
        </template>

        <section class="container m-auto mt-6  md:px-0 sm:px-4">
            <h1 class="text-2xl text-gray-800">
                {{ course.name }} <span class="text-sm text-gray-500">{{ course.code }}</span>
            </h1>
            <span class="text-sm text-gray-500">Grupo: {{ course.group.name}}</span>
            <div class="my-4">
                {{ course.description }}
            </div>
            <hr>

            <div class="mt-6">
                <inertia-link v-for="topic in course.topics"  :key="topic.id"  :href="`/courses/topic/${topic.id}`">
                    <div class="bg-white p-4 shadow rounded-lg mb-4">
                            {{ topic.name}}
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
            course: Object
        }
    }
</script>

<style scoped>

</style>
