<template>
  <div>
      <table class="table w-full table-default">
          <thead>
            <tr>
                <th>Alumno</th>
                <th>Comentario</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="student in students">
                <td>{{ student.name }}</td>
                <td>
                    <textarea
                        class="w-full form-control form-input form-input-bordered"
                        cols="15"
                        rows="3"
                        v-model="student.comment"
                        @change="saveComment(student)"
                    >
                    </textarea>
                </td>
            </tr>
          </tbody>
      </table>
  </div>
</template>

<script>
    const path = '/nova-vendor/teacher-topic-comment'

    export default {
        props: ['resourceName', 'resourceId', 'panel'],

        data: function () {
            return {
                students: Object
            }
        },

        mounted() {
            this.getStudents()
        },

        methods: {
            getStudents: function () {
                Nova.request({
                    url: `${path}/students/${this.resourceId}`,
                    method: 'get'
                }).then(response => {
                    this.students = response.data
                })
            },

            saveComment: function (student) {
                Nova.request().post(`${path}/saveComment/${this.resourceId}`,  {
                    studentId : student.id,
                    comment : student.comment,
                })
            }
        }
    }
</script>
