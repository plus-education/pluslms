<script setup>
    import { Link } from "@inertiajs/inertia-vue3";
</script>

<template>
       <div>
            <h1 class="text-lg mt-6 mb-4 text-gray-800">My Courses</h1>

            <div v-if="!courses || courses.length === 0">
                <h3 class="text-md text-gray-800">You don't have any courses!</h3>
                <h3 class="text-md text-gray-800">Ask your teacher to add you to get started.</h3>
            </div>

            <template v-else>
                <section class="mb-4">
                    <input
                        v-model="search"
                        type="text"
                        class="w-full focus:no-underline py-2 px-4 shadow rounded-lg"
                        placeholder="Search"
                    >
                </section>

                <template v-if="filteredList && filteredList.length > 0">
                    <p v-if="search !== ''">Showing results for '{{ search }}':</p>

                    <section class="grid  lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1">
                        <Link v-for="course in filteredList"  :key="course.id"  :href="`/courses/${course.id}`">
                            <div class="p-2  w-full lg:max-w-full lg:flex">
                                <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" :style="`background-image: url('${course.coverPath}')`" title="Woman holding a mug">
                                </div>
                                <div class="w-full border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                                    <div class="mb-8">
                                        <div class="text-gray-900 font-bold text-xl mb-2">
                                            {{ course.name }}
                                            <p class="text-gray-700 text-sm">
                                                {{ course.code }}
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </Link>
                    </section>
                </template>

                <template v-else>
                    <p v-if="search !== ''">No results for '{{ search }}'.</p>
                </template>
            </template>
       </div>
</template>

<script>
    export default {
        components: {
        },

        props: {
            courses: Object,
        },

        data: () => {
            return {
                search: ''
            }
        },

        computed: {
            filteredList () {
                return this.courses.filter( course => {
                    return course.name.includes(this.search)
                })
            }
        }
    }
</script>

<style scoped>

</style>
