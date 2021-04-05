<template>
  <div>
      <h1 class="text-90 font-normal text-2xl mb-3">
          Commentarios
      </h1>

      <div class="card mb-6 py-4 px-6" v-if="!showAnswers">
          <div class="text-center shadow-md rounded-lg  mb-4 p-4">
              <h2 class="text-90 text-sm mb-4 text-left">Comentar:</h2>
              <vue-editor v-model="comment" :editor-toolbar="customToolbar"  />

              <button
                  class="my-4 btn-default btn-primary"
                  v-if="comment != null  && comment != '' "
                  @click="saveComment()"
              >Commentar</button>
          </div>

          <div v-for="comment in comments" class="mb-4 p-4  shadow-md rounded-lg">
              <div
                  class="flex items-center"
              >
                  <div class="flex-shrink">
                      <img :src="comment.user.profile_photo_url" alt="" class="w-12 rounded-full">
                  </div>
                  <div class="ml-2 flex-1">
                      <div class="flex items-center">
                          <div class="flex-shrink">
                              <h2 class="text-90 text-sm">
                                  {{ comment.user.name }}
                              </h2>
                          </div>
                          <div class="text-xs  bg-gray-200 ml-2 px-2 py-2 rounded-lg">
                              {{ comment.created_at }}
                          </div>
                      </div>

                      <div v-html="comment.comment" class="mt-2"></div>

                      <div class="text-left">
                          <button class="mt-4"  @click="showComment(comment)">
                              <div class="flex items-center align-middle">
                                  <div class="flex-shrink">
                                      <svg class="w-6  text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                      </svg>
                                  </div>

                                  <div class="flex-1 ml-2  text-blue-600">
                                      Respuestas
                                  </div>
                              </div>
                          </button>
                      </div>
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

      <div v-else>
          <div class="mb-4 p-4 shadow-md rounded-lg bg-gray-100">
              <div
                  class="flex items-center"
              >
                  <div class="flex-shrink">
                      <img :src="comment.user.profile_photo_url" alt="" class="w-12 rounded-full">
                  </div>
                  <div class="ml-2 flex-1">
                      <div class="flex items-center">
                          <div class="flex-shrink">
                              <h2 class="text-90 text-sm">
                                  {{ comment.user.name }}
                              </h2>
                          </div>
                          <div class="text-xs  bg-gray-200 ml-2 px-2 py-2 rounded-lg">
                              {{ comment.created_at }}
                          </div>
                      </div>

                      <div v-html="comment.comment" class="mt-2"></div>

                      <div class="text-left">
                          <button class="mt-4" @click="returnToComments()">
                              <div class="flex items-center">
                                  <div class="flex-shrink">
                                      <svg class="w-6  text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                      </svg>
                                  </div>

                                  <div class="flex-1 ml-2  text-green-600">
                                      Regresar
                                  </div>
                              </div>
                          </button>
                      </div>
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

          <div v-for="comment in answers" class="mb-4 p-4  shadow-md rounded-lg bg-white">
              <div
                  class="flex items-center"
              >
                  <div class="flex-shrink">
                      <img :src="comment.user.profile_photo_url" alt="" class="w-12 rounded-full">
                  </div>
                  <div class="ml-2 flex-1">
                      <div class="flex items-center">
                          <div class="flex-shrink">
                              <h2 class="text-90 text-sm">
                                  {{ comment.user.name }}
                              </h2>
                          </div>
                          <div class="text-xs  bg-gray-200 ml-2 px-2 py-2 rounded-lg">
                              {{ comment.created_at }}
                          </div>
                      </div>

                      <div v-html="comment.comment" class="mt-2"></div>
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


          <div class="text-center shadow-md rounded-lg  mb-4 p-4 bg-white">
              <h2 class="text-90 text-sm mb-4 text-left">Responder:</h2>
              <vue-editor v-model="answer" :editor-toolbar="customToolbar"  />

              <button
                  class="my-4 btn-default btn-primary"
                  v-if="answer != null  && answer != '' "
                  @click="saveAnswer()"
              >Responder</button>
          </div>
      </div>

  </div>
</template>

<script>
    import { VueEditor } from "vue2-editor";

    export default {
        props: ['resourceName', 'resourceId', 'panel'],

        components: { VueEditor },

        data: function () {
            return {
                comment: null,
                comments: Object,
                showAnswers: false,
                answer: null,
                answers: Object,
                customToolbar: [
                    ['font' ,"bold", "italic", "underline"],
                    [{ list: "ordered" }, { list: "bullet" }],
                    ["image"]
                ]
            }
        },

        computed: {
            typeOfcomment: function () {
                if(this.panel !== undefined){
                    return this.panel.fields[0].typeOfcomment
                }

                return this.$attrs.field.typeOfcomment
            }
        },

        mounted() {
            this.getComment()
        },

        methods: {
            getComment: function () {
                Nova.request().get(`/commnets/activity/${this.resourceId}/${this.typeOfcomment}`).then(response => {
                    this.comments = response.data
                })
            },

            saveComment: function () {
                let data = {
                    'activityId': this.resourceId,
                    'comment': this.comment
                }

                Nova.request().post(`/commnets/activity/${this.typeOfcomment}`, data).then(response => {
                    this.comments.unshift(response.data)
                })

                this.comment = ''
            },

            deleteComment: function (comment) {
                this.comments = this.comments.filter(item => item.id != comment.id)

                Nova.request().post(`/comments/delete`, {'commentId': comment.id})
            },

            showComment: function (comment) {
                this.comment = comment
                this.showAnswers = true
                this.getAnswers()
            },

            returnToComments: function () {
                this.comment = null
                this.showAnswers = false
                this.answers = Object
            },

            getAnswers: function () {
                Nova.request().get(`/commnets/answers/${this.comment.id}/`).then(response => {
                    this.answers = response.data
                })
            },

            saveAnswer: function () {
                let data = {
                    'activityId': this.resourceId,
                    'comment': this.answer,
                    'parent_id': this.comment.id
                }

                Nova.request().post(`/commnets/storeAnswer/${this.typeOfcomment}`, data).then(response => {
                    this.answers.push(response.data)
                })

                this.answer = ''
            },

        }
    }
</script>
