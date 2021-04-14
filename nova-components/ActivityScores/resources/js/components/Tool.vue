<template>
  <div>
      <h1 class="text-90 font-normal text-2xl mb-3">Calificar</h1>

      <div class="card mb-6">
            <table class="table w-full rounded-lg">
                <thead>
                    <tr>
                        <th></th>
                        <th>
                            Alumno
                        </th>
                        <th>Entrega</th>
                        <th>Modificación</th>
                        <th>
                            Tarea
                        </th>
                        <th>
                            Comentario
                        </th>
                        <th style="width: 200px">
                            Nota
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
                            {{ student.activity.created_at }}
                        </td>
                        <td>
                            {{ student.activity.update_at }}
                        </td>
                        <td class="text-center">
                            <div v-if="student.activity.hasOwnProperty('file')">
                                <a v-show="student.activity.file != null "
                                   :href="`/storage/${student.activity.file}`"
                                   class="btn text-sm px-4 py-2 btn-default"
                                   target="_blank"
                                   download
                                >
                                    Descargar
                                </a>
                            </div>
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
