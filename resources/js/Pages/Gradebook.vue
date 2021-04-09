<template>
    <app-layout>
        <section class="container m-auto my-4">
            <h1 class="text-xl text-gray-700">
                Boleta de Calificaciones
            </h1>

            <div class="">
                <div class="w-3/4 m-auto ">
                    <table class="table table-auto w-full  border-collapse border mt-6 shadow-lg bg-white">
                        <thead class="bg-blue-900 text-white text-90" >
                        <tr>
                            <th class="border border-green-600 px-4 w-2/5">Curso</th>
                            <th class="border border-green-600 px-4">Bimestre 1</th>
                            <th class="border border-green-600 px-4">Bimestre 2</th>
                            <th class="border border-green-600 px-4">Bimestre 3</th>
                            <th class="border border-green-600 px-4">Bimestre 4</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-for="course in gradebook">
                            <td class="border border-green-600 px-4">{{ course.name }}</td>

                            <td
                                class="border border-green-600 px-4 text-center"
                                v-if="course.total < 35"
                            >
                                65
                            </td>


                            <td
                                class="border border-green-600 px-4 text-center"
                                v-else-if="course.total < 55"
                            >
                                72
                            </td>

                            <td
                                class="border border-green-600 px-4 text-center"
                                v-else-if="course.total < 65"
                            >
                                75
                            </td>

                            <td
                                class="border border-green-600 px-4 text-center"
                                v-else-if="course.total < 71"
                            >
                                78
                            </td>

                            <td
                                class="border border-green-600 px-4 text-center"
                                v-else
                            >
                                {{ (course.total  + 5) > 100 ? 100 :  parseInt(course.total)   }}
                            </td>



                            <td class="border border-green-600 px-4"></td>
                            <td class="border border-green-600 px-4"></td>
                            <td class="border border-green-600 px-4"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="" v-if="comments.length > 0">
                <div class="w-3/4 m-auto ">
                    <table class="table table-auto w-full  border-collapse border mt-6 shadow-lg bg-white">
                        <thead>
                            <tr>
                                <th>
                                    Curso
                                </th>
                                <th>
                                    Commentario
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="comment in comments">
                                <td>{{ comment.name }}</td>
                                <td>{{ comment.comment }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </app-layout>
</template>

<script>
    import AppLayout from "../Layouts/AppLayout";

    export default {
        components: {
            AppLayout,
        },

        props: ['gradebook', 'comments']
    }
</script>
