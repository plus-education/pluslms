<template>
    <div>
        <div class="activity-header flex items-center">
            <div class="flex-1">
                <h1 class="text-2xl text-gray-800">
                    {{ activity.name }}
                </h1>
            </div>
        </div>

        <div class="mt-4">
            <div class="px-8" v-html="activity.activityable.html">
            </div>
        </div>

        <div id="questions"
            v-if="activity.isActiveToDo"
        >
            <div class="mt-4 px-8" v-for="(question, index) in exercise.questions">
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

                    <div  v-html="question.html">

                    </div>


                    <div class="w-full mt-2 ml-10"   v-if="question.options != null">
                        <div v-for="(option, indexOption) in question.options"
                             :key="option.id"
                         :class="{'bg-green-200' : option.isCorrect && option.isTrue , 'bg-red-500': !option.isCorrect && option.isChecked && isSended}"
                        >
                            <input type="checkbox"
                                   v-model="exercise.questions[index].options[indexOption].isChecked"
                                   :disabled="isSended ? '' : disabled"
                            >
                            <label for="">{{ option.label }}</label>
                        </div>
                    </div>

                    <div class="w-auto mt-2 mx-10 p-4" v-else>
                        <textarea
                            v-model="exercise.questions[index].openAnswer"
                            class="w-full h-32 border"
                            cols="50"
                            :disabled="isSended ? '' : disabled"
                        ></textarea>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center">

               <div v-if="!hasScore">
                   <button
                       @click="save()"
                       v-if="!isSended"
                       class="btn bg-green-500 py-2 px-4  text-white shadow-lg"
                   >Enviar</button>

               </div>

                <div class="mt-4 px-8" v-if="hasScore">
                    <div>
                        <h1 class="text-2xl text-gray-800">
                            Resultado
                        </h1>
                    </div>
                    <div class="my-4">
                        {{ totalScore }} / {{ activity.score }}
                    </div>
                    <span class="bg-blue-500 text-white shadow px-4 py-2 w-1/3 mt-4">
                        Resultando pendiente de validar por catedratico
                    </span>
                </div>
        </div>
        </div>

        <div
            class="w-full"
            v-else
        >
           <div class="flex justify-center align-middle">
                <div class="text-center">
                    <h2 class="text-2xl">Examen no disponible</h2>
                    <strong>Activo del:</strong> {{ activity.start }}
                    <strong>al:</strong> {{ activity.end }}
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
            showQuizz: true
        },

        data: () => {
           return {
               exercise: Object,
               isLoad: true,
               hasScore: false,
               totalScore: 0,
               isSended: false
           }
        },

        mounted() {
            this.getStatus()
        },

        computed: {
        },

        methods: {
            getStatus: function () {
                axios.get(`/student/exercise/score/${this.activity.id}`).then(response => {
                    if (response.data.hasScore) {
                        this.hasScore = true
                        this.totalScore = response.data.activityScore.score
                        return;
                    }
                    this.getQuestion()
                })
            },

            getQuestion: function () {

                axios.get(`/student/exercise/questions/${this.activity.activityable.id}`).then(response => {
                    this.exercise = response.data
                    this.exercise.questions.map(question => {
                        if(question.options != null) {
                            question.questionable.question_options.map(option => {
                                option.isChecked = false
                                option.isCorrect = false
                                question.openAnswer = false;

                            })
                        }else{
                            question.openAnswer = '';
                        }
                    })
                })
            },

            save: function () {
                //this.isSended = true

                this.exercise.questions.map(question => {
                    if(question.options != null) {
                        question.options.map(option => {
                            option.isCorrect = option.isChecked == option.isTrue ? true : false
                        })
                    }
                })

                let data = {
                    'activityId': this.activity.id,
                    'exercice': this.exercise
                }

                console.log(this.exercise)
                axios.post('/student/exercise/', data).then(response => {
                    this.totalScore = response.data.totalScore
                    this.hasScore = true
                    this.isSended = true
                    console.log(response.data)
                })
            }
        }
    }
</script>
