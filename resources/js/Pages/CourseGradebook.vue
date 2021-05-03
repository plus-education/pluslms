<template>
    <app-layout>

        <div class="container m-auto mt-4">
            <h1 class="text-xl text-gray-700">
                {{ course.name }}
            </h1>
            <span class="text-gray-700">
                {{ topic.name }}
            </span>

            <section class="flex justify-center my-4 w-full">
                <table class="table table-responsive  w-full border-collapse border mt-6 shadow-lg bg-white">
                    <thead class="bg-blue-900 text-white text-90">
                    <tr>
                        <th class="border border-green-600 px-4 w-2/5">Actividad</th>
                        <th class="border border-green-600 px-4 w-1/6">Fecha de entrega</th>
                        <th class="border border-green-600 px-4 w-1/6">Punteo</th>
                        <th class="border border-green-600 px-4 w-3/5">Comentarios</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="activity in gradebook">
                        <td class="border border-gray-6000 px-4">{{ activity.name }}</td>
                        <td class="border border-gray-6000 px-4 text-center">{{ activity.end }}</td>
                        <td class="border border-gray-6000 px-4 text-center">{{ activity.result }} / {{ activity.score }} </td>
                        <td class="border border-gray-6000 px-4">{{ activity.comment }}</td>
                    </tr>
                    </tbody>
                </table>
            </section>

            <div class="flex justify-center">
                <div class="mt-6 w-auto m-auto container flex items-center">
                    <div class="text-center flex item-center">
                        <img src="/img/score.png" class="w-16 h-16">
                    </div>
                    <div class="text-center text-xl">
                        <strong>Punteo: </strong>{{ totalResult }} / {{ totalScore }}
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from "../Layouts/AppLayout";

    export default {
        components: {
            AppLayout,
        },

        props: ['course', 'topic', 'gradebook', 'totalScore', 'totalResult']
    }
</script>
