<template>
    <app-layout>
        <template #header>
            <ul class="list-reset flex text-grey-dark">
                <li>
                    <a href="/dashboard">Inicio</a>
                </li>

                <li><span class="mx-2">/</span></li>

                <li >
                    <inertia-link>
                        {{ topic.course.name }}
                    </inertia-link>
                </li>

                <li><span class="mx-2">/</span></li>

                <li>Dashboard</li>
            </ul>
        </template>

        <section class="container m-auto mt-6  md:px-0 sm:px-4">
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
