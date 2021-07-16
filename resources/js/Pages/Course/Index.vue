<template>
    <app-layout>
        <template #header>
            <ul>
                <li>Inicio</li>
            </ul>
        </template>

        <section class="container m-auto mt-6  md:px-0 sm:px-4">
            <header class=" shadow rounded-lg p-8 md:h-48 sm:h-32  bg-cover"
                :style="`background-image: url('${course.coverPath}')`"
            >
                <div>
                    <h1 class="text-2xl text-white font-bold">
                        {{ course.name }} <span class="text-sm text-white">{{ course.code }}</span>
                    </h1>
                    <span class="text-sm text-white">Grupo: {{ course.group.name}}</span>
                </div>

                <div class="mt-4" v-if="course.classLink != null  || course.classLink != ''">
                    <a
                        :href="course.classLink"
                        target="_blank"
                        class="bg-white py-2 px-4 rounded-lg shadow"
                    >
                        Ingresar a Clase virtual
                    </a>
                </div>
            </header>

            <div class="my-4" v-html="course.html">
            </div>

            <div class="mt-6">
                <inertia-link
                    v-for="topic in course.topics"
                    :key="topic.id"
                    :href="`/courses/topic/${topic.id}`"
                    v-if="topic.isShow"
                >
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
