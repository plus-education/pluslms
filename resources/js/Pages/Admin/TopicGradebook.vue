<template>
<div>
    <section class="my-6 mx-4">
        <span class="text-xs text-white bg-green-500 px-4 py-1 mx-1 my-5">
            {{ group.name }}
        </span>
        <h1 class="text-2xl">{{ topic.course.name }}</h1>
        <span>{{ topic.name}}</span>
    </section>

    <div class="m-4">
        <table class="bg-white shadow">
            <tr>
                <td class="px-2 py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </td>
                <td class="px-2 py-4">Sin entrega - Maestro asigno punteo</td>
            </tr>
            <tr class="p-4">
                <td class="px-2 py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                </td>
                <td class="px-2 py-4">Descargar Tarea</td>
            </tr>
            <tr class="p-4">
                <td class="px-2 py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </td>
                <td class="px-2 py-4"   >Sin entrega</td>
            </tr>
        </table>
    </div>

    <section class="zui-wrapper w-full">
        <div class="zui-scroller">
            <table class="table-fixed zui-table">
                <thead>
                <tr>
                    <th class="zui-sticky-col">Estudiantes</th>
                    <th  class="text-xs w-64 "  v-for="activity in activities">{{ activity.name}}</th>
                    <th class="zui-sticky-col-end">
                        Total
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="student in students">
                    <td class="zui-sticky-col">
                        {{student.name}}
                    </td>
                    <td v-for="activity in activities"
                        class="py-1 px-2"
                    >
                        <div class="flex justify-center">
                            <div v-if="student.scores.hasOwnProperty(activity.id)" class="flex">
                                <a
                                    alt="Descargar Tarea"
                                    v-if="student.scores[activity.id].file != null"
                                    :href="`/storage/${student.scores[activity.id].file}`"
                                    download
                                    class="mr-4"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                </a>

                                <a alt="Sin entregar" v-else class="mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </a>

                                <input
                                    class="w-14 px-2"
                                    type="number"
                                    :max="activity.score"
                                    min="0"
                                    v-model="student.scores[activity.id].score"
                                    v-on:change="updateScore(student, student.scores[activity.id])"
                                >
                            </div>
                            <div v-else class="flex">
                                <span class="mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>

                                <input class="w-14 px-2"
                                       :id="'score-' + student.id + '-' + activity.id"
                                       type="number" value="0"
                                       v-on:change="saveScore(student, activity)"
                                >
                            </div>

                            <div>
                                /{{ activity.score }}
                            </div>
                        </div>

                    </td>

                    <td class="zui-sticky-col-end">
                        {{ student.total }} pts.
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>
</template>

<script>
    export default {
        props: ['group', 'topic', 'students', 'activities'],

        mounted() {

        },

        methods : {
            updateScore(student, score) {
                axios.post(`/topicGradebook/update/${this.topic.id}/${student.id}`, {
                    'activity_id' : score.activity_id,
                    'score': score.score
                })
                    .then(response => {
                        student.total = response.data.total
                    })
            },

            saveScore(student, activity) {
                let scoreId = 'score-' + student.id + '-' + activity.id

                /*axios.post(`/topicGradebook/save/${student.id}/${activity.id}`, {
                    'score': document.getElementById(scoreId).value,
                    'topicId': this.topic.id
                })
                    .then(response => {
                        student.total = response.data.total
                        student.scores.push(response.data.newScore)
                    })*/
            }
        }
    }
</script>

<style>
body{
    background-color: #EEF1F4;
}

.zui-table {
    border: none;
    border-right: solid 1px #DDEFEF;
    border-collapse: separate;
    border-spacing: 0;
    font: normal 13px Arial, sans-serif;
}
.zui-table thead th {
    background-color: #DDEFEF;
    border: none;
    color: #336B6B;
    padding: 10px;
    text-align: left;
    text-shadow: 1px 1px 1px #fff;
    white-space: nowrap;
}
.zui-table tbody td {
    border-bottom: solid 1px #DDEFEF;
    color: #333;
    padding: 10px;
    text-shadow: 1px 1px 1px #fff;
    white-space: nowrap;
}
.zui-wrapper {
    position: relative;
}
.zui-scroller {
    margin-left: 350px;
    margin-right: 75px;
    overflow-x: scroll;
    overflow-y: visible;
    padding-bottom: 5px;
}
.zui-table .zui-sticky-col {
    border-left: solid 1px #DDEFEF;
    border-right: solid 1px #DDEFEF;
    left: 0;
    position: absolute;
    top: auto;
    background: aliceblue;
    width: 350px;
}

.zui-table .zui-sticky-col-end {
    border-left: solid 1px #DDEFEF;
    border-right: solid 1px #DDEFEF;
    right: 0;
    position: absolute;
    top: auto;
    background: aliceblue;
    width: 75px;
    text-align: center;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}
</style>
