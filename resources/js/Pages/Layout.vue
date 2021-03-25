<template>
    <main class="">
        <header class="fixed  bg-orange-500 top-0 p-2 w-full shadow">
            <div class="container m-auto">
                <h1 class="text-2xl text-white">LMS</h1>
            </div>
        </header>

        <section class="container md:mx-auto mt-16 mb-24 sm:mx-8">
            <slot/>
        </section>

        <footer class="fixed bg-orange-500 bottom-0 p-2 w-full shadow">
           <div class="container m-auto">
               <div class="flex">
                   <div class="flex-auto text-center">
                       <a  href="" class="flex flex-col items-center text-white hover:text-orange-500 ">
                           <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                           </svg>
                           <div class="text-sm">
                               home
                           </div>
                       </a>
                   </div>



                   <div class="flex-auto text-center">
                       <a  href="" class="flex flex-col items-center text-white hover:text-orange-500 ">
                           <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                           </svg>
                           <div class="text-sm">
                               Agenda
                           </div>
                       </a>
                   </div>


                   <div class="flex-auto text-center">
                       <a  href="" class="flex flex-col items-center text-white hover:text-orange-500 ">
                           <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                           </svg>
                           <div class="text-sm">
                               Notificaciones
                           </div>
                       </a>
                   </div>

                   <div class="flex-auto text-center">
                       <a  href="" class="flex flex-col items-center text-white hover:text-orange-500 ">
                           <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                           </svg>
                           <div class="text-sm">
                               Notas
                           </div>
                       </a>
                   </div>
               </div>
           </div>
        </footer>
    </main>
</template>

<script>
    export default {

    }
</script>
