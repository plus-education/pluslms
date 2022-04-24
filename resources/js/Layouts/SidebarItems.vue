<script setup>
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
    <ul>
        <template :key="t.id" v-for="t in topics">
            <li class="p-2">
                <Link :href="route('courses.topic', t.id)">
                    <h3 class="text-md" :class="{ 'font-bold' : topic.id === t.id }">{{ t.name }}</h3>
                </Link>
                <ul v-if="topic.id === t.id && topic.activities">
                    <template 
                    :key="activity.id" 
                    v-for="activity in topic.activities"
                    >
                        <li
                            class="cursor-pointer"
                            v-show="activity.isShow == 1"
                            @click="$emit('changeActivity', activity)">
                            <div 
                                class="p-2 w-full hover:bg-gray-200 inline-block"
                                :class="activity.activeClass"
                            >
                                <span class="inline-block pr-2" style="height:18px;" v-html="icons[activity.type]"></span>
                                <!--<span v-if="t.completed">&#9745;</span>-->
                                {{ activity.name }}
                            </div>
                        </li>
                    </template>
                </ul>
            </li>
        </template>
    </ul>
</template>

<script>
export default {
    props: {
        topic: Object,
        topics: Object,
        icons: Object,
    }
}
</script>
