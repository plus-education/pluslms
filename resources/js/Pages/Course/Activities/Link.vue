<template>
  <div class="h-full overflow-hidden">
      <div class="activity-header flex items-center">
          <div class="flex-1">
              <h1 class="text-2xl text-gray-800">
                  {{ activity.name }}
              </h1>
          </div>
      </div>

      <link-preview :url="activity.activityable.link">

      </link-preview>


      <comments :activity="activity" :user="user"></comments>
  </div>
</template>

<script>
    import Comments from "../Comments";
    import LinkPreview from '@ashwamegh/vue-link-preview'


    export default {
        components: {
            Comments,
            LinkPreview,
        },

        props: {
            activity: Object,
            user: Object,
        },

        mounted: {

        },

        methods: {
            handleClick(preview) {
                console.log('click', preview.domain, preview.title, preview.description, preview.img)
            }
        }
    }
</script>

<style scoped>

</style>
