<template>
  <div>
      <h1 class="text-90 font-normal text-2xl mb-3">Activity Scores</h1>

      <div class="card mb-6">
            <table class="table w-full rounded-lg">
                <thead>
                    <tr>
                        <th></th>
                        <th>
                            Student
                        </th>
                        <th>
                            Comment
                        </th>
                        <th style="width: 200px">
                            Score
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="student in students" :key="student.id">
                        <td
                            class="py-4"
                            style="width: 75px"
                        >
                            <img
                                class="w-full rounded-full"
                                :src="student.profile_photo_url"
                                alt=""
                            >
                        </td>
                        <td>
                            {{ student.name }}
                        </td>
                        <td>
                            <input
                                type="text"
                                class="w-full form-control form-input form-input-bordered"
                                v-model="student.activity.comment"
                                @change="saveScore(student)"
                            >
                        </td>
                        <td>
                         <div  class="flex items-center">
                             <div class="flex-1 mr-2">
                                 <input
                                     type="number"
                                     :max="activity.score"
                                     class="w-full form-control form-input form-input-bordered"
                                     v-model="student.activity.score"
                                     @change="saveScore(student)"
                                 >
                             </div>

                             <div class="flex-1">
                                 / {{ activity.score }}
                             </div>
                         </div>

                        </td>
                    </tr>
                </tbody>
            </table>
      </div>
  </div>
</template>

<script>
    export default {
        props: ['resourceName', 'resourceId', 'panel'],

        data: () => {
            return {
                activity: Object,
                students: Object,
            }
        },

        mounted() {
            this.activity = this.panel.fields[0].model
            this.getStudents()
        },

        methods: {
            getStudents: function() {
                Nova.request({
                    url: `/courses/usersByActivity/${this.activity.id}`,
                    method: 'get',
                }).then(response => {
                    this.students = response.data
                })
            },

            saveScore: function(student) {
                if(student.activity.score > this.activity.score) {
                   // student.activity.score = this.activity.score
                }

                Nova.request().post(`/courses/saveActivity`,  {
                    activity_id : this.activity.id ,
                    student_id : student.id,
                    comment : student.activity.comment,
                    score: student.activity.score
                })

            }
        }

    }
</script>
