<template>
    <app-layout>
        <template #header>
           <ul>
               <li>Inicio</li>
           </ul>
        </template>

        <section class="container m-auto">
            <div>
                <div v-html="group.html"></div>
            </div>

            <hr>

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
            courses: Object,
            group: Object,
        },
    }
</script>
