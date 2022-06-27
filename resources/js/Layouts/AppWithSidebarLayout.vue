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

        <!--<template #sidebar>
            <SidebarItems
                :topic="topic"
                :topics="topics"
                :icons="icons"
                :activity="activity"
            />
        </template>-->
        <template #sidebar>
            <p>Testing</p>
        </template>

        <div class="flex flex-wrap bg-gray-100 w-full">
            <div class="z-50
                w-[length:var(--sidebar-w)]
                overflow-y-scroll fixed
                top-[length:var(--navbar-h)]
                bottom-0 bg-white shadow-lg hidden md:block
            ">
                <div class="p-3 text-ellipsis">
                    <h4>Course:</h4>
                    <h5>{{ topic.course.name }}</h5>
                </div>
                <hr class="m-0" />
                <SidebarItems
                    :topic="topic"
                    :topics="topics"
                    :icons="icons"
                    :activity="activity"
                />
            </div>

            <div class="
                z-0 w-full md:w-9/12 h-screen absolute
                top-[length:var(--navbar-h)]
                left-0
                md:left-[length:var(--sidebar-w)]">
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
        activity: Object,
    },
  }
</script>
