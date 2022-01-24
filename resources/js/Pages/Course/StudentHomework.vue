<template>
  <app-layout>
      <template #header>
          <ul class="list-reset flex text-grey-dark">
              <li>
                  <a href="/dashboard">Inicio</a>
              </li>

              <li><span class="mx-2">/</span></li>

              <li >
                  <inertia-link :href="`/courses/${course.id}`">
                      {{ course.name }}
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

      <div class="container m-auto my-6 shadow-lg bg-white">
          <homework :activity="homework" :user="user"></homework>
      </div>
  </app-layout>
</template>

<script>
import AppLayout from './../../Layouts/AppLayout'
import Homework from './Activities/Homework'

export default {
    components: {
        AppLayout,
        Homework
    },

    props: {
        homework: Object,
        user: Object,
        topic: Object,
        course: Object,
    }
}
</script>
