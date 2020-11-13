<template>
    <div class="border-t pt-4">
        <div class="flex items-center">
            <div class="mr-2">
                <svg class="w-8 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                </svg>
            </div>

            <div>
                <h1 class="text-2xl text-gray-800">Comentarios</h1>
            </div>
        </div>

        <div class="card mb-6 py-4 px-6">
            <div class="text-center border-b border-gray-300">
                <h2 class="text-90 text-sm mb-4 text-left">Comentar:</h2>
                <textarea v-model="comment" class="w-full form-control form-input form-input-bordered py-3 h-auto  mb-2"></textarea>

                <button
                    class="my-4 bg-green-500 shadow px-4 py-2 text-white rounded"
                    v-if="comment != null  && comment != '' "
                    @click="saveComment()"
                >Comentar</button>
            </div>

            <div
                v-for="comment in comments"
                class="border-b border-gray-300 py-4 flex items-center"
            >
                <div class="flex-shrink">
                    <img :src="comment.user.profile_photo_url" alt="" class="w-12 rounded-full">
                </div>
                <div class="ml-2 flex-1">
                    <h2 class="text-90 text-sm">{{ comment.user.name }}</h2>

                    {{ comment.comment }}
                </div>

                <div
                    v-if="user.id == comment.user.id"
                    class="flex-shrink"
                >
                    <button @click="deleteComment(comment)">
                        <svg class="w-4 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: {
            activity: Object,
            user: Object
        },

        data: function () {
            return {
                comment: null,
                comments: Object
            }
        },

        mounted() {
            this.getComment()
        },

        methods: {
            getComment: function () {
                axios.get(`/commnets/activity/${this.activity.id}`).then(response => {
                    this.comments = response.data
                })
            },

            saveComment: function () {
                let data = {
                    'activityId': this.activity.id,
                    'comment': this.comment
                }

                axios.post(`/commnets/activity`, data).then(response => {
                    this.comments.unshift(response.data)
                })

                this.comment = ''
            },

            deleteComment: function (comment) {
                this.comments = this.comments.filter(item => item.id != comment.id)

                axios.post(`/comments/delete`, {'commentId': comment.id})
            }
        }
    }
</script>

<style scoped>

</style>
