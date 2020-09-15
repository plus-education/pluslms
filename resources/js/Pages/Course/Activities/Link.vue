<template>
  <div class="h-full overflow-hidden">
      <h1 class="text-2xl text-gray-800">
          {{ activity.name }}
      </h1>
      <hr>

      <iframe
          class="w-full h-full overflow-scroll"
          :src="activity.activityable.link"
          frameborder="0"
      ></iframe>
  </div>
</template>

<script>
    export default {
        props: {
            activity: Object
        }
    }
</script>

<style scoped>

</style>
