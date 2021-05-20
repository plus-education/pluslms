<template>
    <app-layout>
        <div class="container m-auto">
            <h1 class="text-lg mt-6 mb-4 text-gray-800">Mis Activdades</h1>
        </div>

        <section class="relative container m-auto my-6 bg-white shadow-lg"  style="height: 600px">
            <vue-cal
                :time="false"
                :disable-views="['years', 'year']"
                resize-x
                :events="events"
                locale="es"
            />
        </section>
    </app-layout>
</template>

<script>
import AppLayout from './../Layouts/AppLayout'
// In your Vue.js component.
import VueCal from 'vue-cal'
import 'vue-cal/dist/i18n/es.js'
import 'vue-cal/dist/vuecal.css'

export default {
    components: {
        AppLayout,
        VueCal
    },

    data() {
        return {
            events: [],
        }
    },

    mounted() {
        axios.get('/student/myActivities').then(response => {
            this.events = response.data
        })
    }
}
</script>

<style>
.event-1{
    background-color: #03A9F4;
    color: #fff;
    border: #E5E5E5 3px solid;
}

.event-2 {
    background-color: #00BCD4;
    color: #fff;
    border: #E5E5E5 3px solid;
}

.event-3 {
    background-color: #4CAF50;
    color: #fff;
    border: #E5E5E5 3px solid;
}

.event-4 {
    background-color: #607D8B;
    color: #fff;
    border: #E5E5E5 3px solid;
}

.event-5 {
    background-color: #673AB7;
    color: #fff;
    border: #E5E5E5 3px solid;
}

.event-6 {
    background-color: #9C27B0;
    color: #fff;
    border: #E5E5E5 3px solid;
}

.event-7 {
    background-color: #E91E63;
    color: #fff;
    border: #E5E5E5 3px solid;
}

.event-8 {
    background-color: #CDDC39;
    color: #fff;
    border: #E5E5E5 3px solid;
}

.event-9 {
    background-color: #795548;
    color: #fff;
    border: #E5E5E5 3px solid;
}

.event-10 {
    background-color: #FF5252;
    color: #fff;
    border: #E5E5E5 3px solid;
}


</style>
