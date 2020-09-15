<template>
   <div class="">
       <div>
           <h1 class="text-2xl text-gray-800">
               {{ activity.name }}
           </h1>
           <hr>
       </div>

       <div class="flex items-center justify-center mt-8 w-full h-64 bg-gray-100 border-dashed border-4 border-gray-600">
              <a
                  class="bg-blue-100 px-6 py-4 shadow rounded-lg font-bold"
                  :href="`/storage/${activity.activityable.path}`"
                  target="_blank"
              >Descargar</a>
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
