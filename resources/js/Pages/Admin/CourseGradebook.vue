<template>
    <div class="flex p-4 items-center shadow-md border border-gray-300 rounded-lg mb-4 bg-white">
        <div>
            <h1 class="text-xl text-gray-700 font-bold">
                {{ course.name }}
            </h1>
        </div>

        <div class="flex ml-4 px-4  place-content-center">
            <div
                class="border-l border-r border-green-300 px-4 "
                v-for="module in course.modules">
                <h3 class="text-center font-bold">
                    {{ module.name }}
                </h3>
                <div class="text-center">
                    {{ module.totalStudentScore }} / {{ module.totalScore }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['course'],
}
</script>

<style scoped>

</style>
