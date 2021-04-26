<template>
    <div class="flex relative">
        <button class="flex text-sm border-2 border-transparent my-4" @click="toogleShowNotification()">
            <svg data-v-f76a318a="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="text-90 w-6 h-6">
                <path data-v-f76a318a="" d="M15 19a3 3 0 0 1-6 0H4a1 1 0 0 1 0-2h1v-6a7 7 0 0 1 4.02-6.34 3 3 0 0 1 5.96 0A7 7 0 0 1 19 11v6h1a1 1 0 0 1 0 2h-5zm-4 0a1 1 0 0 0 2 0h-2zm0-12.9A5 5 0 0 0 7 11v6h10v-6a5 5 0 0 0-4-4.9V5a1 1 0 0 0-2 0v1.1z"></path>
            </svg>

            <svg  xmlns="http://www.w3.org/2000/svg"  class="ml-2 text-90 w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div class="absolute z-50 mt-2 rounded-md shadow-lg origin-top-right right-0 mt-12" v-if="isShow">
            <div class="shadow-lg border-gray-900 bg-white mt-2 rounded-lg" style="width: 600px">
                <div class="flex justify-between bg-gray-200 py-2 px-2">
                    <div>
                        <h1 class="text-lg font-bold">Notificaciones</h1>
                    </div>
                    <div>
                        <button class="text-lg font-bold">
                            Marcar todo como leído
                        </button>
                    </div>
                </div>
                <div v-for="notification in notifications" class="mx-4 mt-2">
                    <h2 class="text-lg text-blue-500 font-bold">{{ notification.data.title }}</h2>
                    <div class="border-t border-gray-100"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                notifications: Object,
                isShow: false
            }
        },

        mounted() {
            axios.get('/notifications').then(response => {
                this.notifications = response.data
            })
        },

        methods: {
            toogleShowNotification: function() {
                if(this.isShow) {
                    return this.isShow = false
                }

                this.isShow = true
            }
        }
    }
</script>

<style scoped>

</style>
