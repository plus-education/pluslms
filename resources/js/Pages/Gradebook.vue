<template>
    <app-layout>
        <section class="container m-auto my-4">
            <h1>
                Boleta de Calificaciones
            </h1>

            <div class="">
                <div class="w-3/4 m-auto ">
                    <table class="table table-auto w-full  border-collapse border mt-6 shadow-lg bg-white">
                        <thead>
                        <tr>
                            <th class="border border-green-600 px-4 w-2/5">Curso</th>
                            <th class="border border-green-600 px-4">Bimestre 1</th>
                            <th class="border border-green-600 px-4">Bimestre 2</th>
                            <th class="border border-green-600 px-4">Bimestre 3</th>
                            <th class="border border-green-600 px-4">Bimestre 4</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td class="border border-green-600 px-4">Matematicas</td>
                            <td class="border border-green-600 px-4">10</td>
                            <td class="border border-green-600 px-4"></td>
                            <td class="border border-green-600 px-4"></td>
                            <td class="border border-green-600 px-4"></td>
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
    }
</script>
