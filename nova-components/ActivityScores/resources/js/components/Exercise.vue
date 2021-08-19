<template>
    <div>
        <div
            v-if="!isShowExercise"
            class="card mb-6"
        >
            <table class="table w-full rounded-lg">
                <thead>
                <tr>
                    <th></th>
                    <th>
                        Alumno
                    </th>
                    <th>Entrega</th>
                    <th style="width: 200px">
                        Nota
                    </th>
                    <th></th>
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
                    <td class="text-center">
                        {{ student.activity.score }}
                    </td>
                    <td>
                        <button @click="showExercise(student)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="18" viewBox="0 0 22 16" aria-labelledby="view" role="presentation" class="fill-current"><path d="M16.56 13.66a8 8 0 0 1-11.32 0L.3 8.7a1 1 0 0 1 0-1.42l4.95-4.95a8 8 0 0 1 11.32 0l4.95 4.95a1 1 0 0 1 0 1.42l-4.95 4.95-.01.01zm-9.9-1.42a6 6 0 0 0 8.48 0L19.38 8l-4.24-4.24a6 6 0 0 0-8.48 0L2.4 8l4.25 4.24h.01zM10.9 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path></svg>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div
            v-else
            class="bg-white shadow p-4"
        >
            <h3>Respuesta de {{ student.name }} </h3>
            <div class="mt-4 px-8" v-for="(question, index) in studentExercise">
                <div class="border-b border-gray-200 px-8 py-2">
                    <div class="flex items-center">
                        <div class="flex-shrink">
                            <svg class="w-8 text-green-400 mr-2"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h2 class="font-bold">{{ question.name }}</h2>
                        </div>
                    </div>

                    <div  v-html="question.html"></div>


                    <div class="w-full mt-2 ml-10"   v-if="question.options != null">
                        <div v-for="(option, indexOption) in question.options"
                             :key="option.id"
                             :class="{'bg-green-200' : option.isCorrect && option.isTrue , 'bg-red-500': !option.isCorrect && option.isChecked}"
                        >
                            <input type="checkbox"
                                   :checked="option.isChecked"
                            >
                            <label for="">{{ option.label }}</label>
                        </div>
                    </div>

                    <div class="w-auto mt-2 mx-10 p-4" v-else>
                        <textarea
                            class="w-full h-32 border"
                            cols="50"
                            disabled
                        >
                            {{ question.openAnswer }}
                        </textarea>


                        <div class="mt-4">
                            <strong>Calificar: </strong>
                            <input type="number"
                                   min="0"
                                   :max="question.score"
                                   class="w-32 border px-4 py-2 text-right"
                                   v-model="studentExercise[index].result"
                            >
                            / {{ question.score }}
                        </div>
                    </div>
                </div>
            </div>

            <div  class="flex justify-center my-6"
                  v-if="isShowExercise">
                <div>
                    <button class="bg-gray-100 shadow px-6 py-2"
                        @click="backToListOfStudents()"
                    >
                        Regresar
                    </button>
                </div>
                <div class="ml-6">
                    <button class="bg-green-500 text-white shadow px-6 py-2"
                            @click="save()"
                    >
                        Calificar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['activity', 'students'],

        data: () => {
            return {
                isShowExercise: false,
                studentExercise: Object,
                student: Object,
            }
        },

        mounted() {
        },

        methods: {
            showExercise(student) {
                this.studentExercise = JSON.parse(student.activity.text).questions
                this.student = student
                this.isShowExercise = true
                console.log(this.studentExercise)
            },

            backToListOfStudents() {
                this.student = Object
                this.studentExercise = Object
                this.isShowExercise = false
            },

            save() {
                let data = {
                    'activityId': this.activity.id,
                    'exercice': {
                            questions: this.studentExercise
                    }
                }

                console.log(data)

                axios.post('/student/exercise', data).then(response => {
                    location.reload();
                })

            }
        }
    }
</script>
