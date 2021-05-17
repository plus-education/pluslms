<template>
    <app-layout>

        <div class="container m-auto my-6">
            <h1 class="text-2xl font-bold text-gray-700">{{ gradebook.student.name }}</h1>
            <h3>
                {{ gradebook.group.name }}
            </h3>
        </div>

       <div class="container m-auto">
           <course-gradebook
               v-for='course in gradebook.courses'
               key="course.id"
               :course="course"
           />
       </div>
    </app-layout>
</template>

<script>
import CourseGradebook from './CourseGradebook'


export default {
    props : ['gradebook'],

    components: {
        CourseGradebook
    }
}
</script>

<style>
 body{
     background-color: #EEF1F4;
 }
</style>
