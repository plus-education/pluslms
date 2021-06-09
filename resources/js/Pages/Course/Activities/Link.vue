<template>
  <div class="h-full overflow-hidden">
      <div class="activity-header flex items-center">
          <div class="flex-1">
              <h1 class="text-2xl text-gray-800">
                  {{ activity.name }}
              </h1>
          </div>
      </div>

      <iframe
          class="w-full h-full overflow-scroll"
          :src="activity.activityable.link"
          frameborder="0"
      ></iframe>

      <comments :activity="activity" :user="user"></comments>
  </div>
</template>

<script>
    import Comments from "../Comments";

    export default {
        components: {
            Comments,
        },

        props: {
            activity: Object,
            user: Object,
        }
    }
</script>

<style scoped>

</style>
