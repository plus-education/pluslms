<template>
  <div class="h-full overflow-hidden">
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
