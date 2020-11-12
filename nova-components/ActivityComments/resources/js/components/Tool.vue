<template>
  <div>
      <h1 class="text-90 font-normal text-2xl mb-3">
          Commentarios
      </h1>

      <div class="card mb-6 py-4 px-6">
          <div class="text-center border-b border-gray-300">
              <h2 class="text-90 text-sm mb-4 text-left">Comentar:</h2>
              <textarea v-model="comment" class="w-full form-control form-input form-input-bordered py-3 h-auto  mb-2"></textarea>

              <button
                  class="my-4 btn-default btn-primary"
                  v-if="comment != null  && comment != '' "
                  @click="saveComment()"
              >Commentar</button>
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
              <div class="flex-shrink">
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
        props: ['resourceName', 'resourceId', 'panel'],

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
                Nova.request().get(`/commnets/activity/${this.resourceId}`).then(response => {
                    this.comments = response.data
                })
            },

            saveComment: function () {
                let data = {
                    'activityId': this.resourceId,
                    'comment': this.comment
                }

                Nova.request().post(`/commnets/activity`, data).then(response => {
                    this.comments.unshift(response.data)
                })

                this.comment = ''
            },

            deleteComment: function (comment) {
                this.comments = this.comments.filter(item => item.id != comment.id)

                Nova.request().post(`/comments/delete`, {'commentId': comment.id})
            }
        }
    }
</script>
