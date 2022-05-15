<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SidebarItems from '@/Layouts/SidebarItems.vue';
import { CButton, CAccordion, CAccordionItem, CAccordionHeader, CAccordionBody } from '@coreui/vue'
import { Link } from '@inertiajs/inertia-vue3'
</script>

<template>
    <AppLayout :fullHeight="true" :hasSidebar="true">
        <template v-if="$slots.header" #header>
            <slot name="header" />
        </template>

        <template v-if="$slots.sidebar" #sidebar>
            <SidebarItems
                :topic="topic"
                :topics="topics"
                :icons="icons"
                @change-activity="(a) => $emit('changeActivity', a)"
            />
        </template>

        <div class="flex flex-wrap bg-gray-100 w-full overflow-y-scroll">
            <div class="w-3/12 h-screen overflow-y-auto bg-white shadow-lg hidden md:block">
                <div class="p-3 text-ellipsis">
                    <h4>Course:</h4>
                    <h5>{{ topic.course.name }}</h5>
                </div>
                <hr class="m-0" />
                <SidebarItems
                    :topic="topic"
                    :topics="topics"
                    :icons="icons"
                    @change-activity="(a) => $emit('changeActivity', a)"
                />
            </div>

            <div class="w-full md:w-9/12 h-screen overflow-y-scroll">
                <div class="md:p-4">
                    <slot />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
  export default {
    props: {
        topic: Object,
        topics: Object,
        fullHeight: Boolean,
        icons: Object,
    },
    emits: ['changeActivity']
  }
</script>