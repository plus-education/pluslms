<template>
    <app-layout>
        <div class="container m-auto my-6">
            <div>
                <h1 class="text-gray-700 text-2xl font-bold">Grupo: {{ group.name }}</h1>
            </div>


            <div class="py-6">
                <input
                    type="text"
                    v-model="search"
                    placeholder="Filtrar alumno"
                    class="px-4 py-2 rounded-full w-full"
                />
            </div>


            <div>
                <div
                    v-for="student in filteredList"
                    :key="student.id"
                    class="flex p-4 items-center shadow-md border border-gray-300 rounded-lg mb-4 bg-white"
                >
                    <a :href="`/groupGradebook/gradebook/${group.id}/${student.id}`" target="_blank">
                        {{ student.name }}
                    </a>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
export default {
    props: [
        'group', 'students'
    ],

    data: function () {
        return {
            search: ''
        }
    },

    computed: {
        filteredList() {
            return this.students.filter(student => {
                return student.name.toLowerCase().includes(this.search.toLowerCase())
            })
        }
    }
}
</script>

<style>
body{
    background-color: #EEF1F4;
}
</style>
