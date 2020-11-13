<template>
    <div>
        <div class="mt-4">
            <div class="px-8" v-html="activity.activityable.html">
            </div>
        </div>

        <div id="questions">
            <div class="mt-4 px-8" v-for="(question, index) in exercise.questions">
                <div class="card shadow-lg border border-gray-300 px-8 py-2">
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

                    <div  v-html="question.html">

                    </div>

                    <hr>

                    <div class="w-full mt-2 ml-10">
                        <div v-for="(option, indexOption) in question.questionable.question_options">
                            <input type="checkbox"  v-model="exercise.questions[index].questionable.question_options[indexOption].isChecked">
                            <label for="">{{ option.label }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center">
            <button
                @click="save()"
                v-if="!isSended"
                class="btn bg-green-500 py-2 px-4  text-white shadow-lg"
            >Enviar</button>


            <div class="mt-4 px-8">
                <div>
                    <h1 class="text-2xl text-gray-800">
                        Resultado
                    </h1>
                </div>
                <div>
                    {{ totalScore }} / {{ activity.score }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            activity: Object,
            user: Object,
        },

        data: () => {
           return {
               exercise: Object,
               isLoad: true,
               totalScore: 0,
               isSended: false
           }
        },

        mounted() {
            this.getQuestion()
        },

        methods: {
            getQuestion: function () {
                axios.get(`/student/exercise/questions/${this.activity.activityable.id}`).then(response => {
                    this.exercise = response.data
                    this.exercise.questions.map(question => {
                        question.questionable.question_options.map(option => {
                            option.isChecked = false
                        })
                    })
                })
            },

            save: function () {
                this.isSended = true

                this.exercise.questions.map(question => {
                    question.questionable.question_options.map(option => {
                        option.isCorrect = option.isChecked == option.isTrue ? true : false
                    })
                })

                let data = {
                    'activityId': this.activity.id,
                    'exercice': this.exercise
                }

                axios.post('/student/exercise/', data).then(response => {
                    this.totalScore = response.data.totalScore
                    console.log(response.data)
                })
            }
        }
    }
</script>
