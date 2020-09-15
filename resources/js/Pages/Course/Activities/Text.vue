<template>
  <div>
      <h1 class="text-2xl text-gray-800">
          {{ activity.name }}
      </h1>
      <hr>

      <div class="mt-4">
          {{ activity.activityable.body }}
      </div>
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
