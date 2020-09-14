<template>
    <app-layout>
        <template #header>
           <ul>
               <li>Inicio</li>
           </ul>
        </template>

        <section class="container m-auto">
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
        },
    }
</script>
