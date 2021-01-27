<template>
    <div>
        <div class="mt-4" v-html="activity.activityable.html">
        </div>

        <div class="flex items-center justify-center mt-8 w-full">
            <a
                v-if="activity.activityable.file != null"
                class="bg-blue-100 px-6 py-4 shadow rounded-lg font-bold"
                :href="`/storage/${activity.activityable.path}`"
                target="_blank"
            >Descargar Documento Adjunto</a>
        </div>

        <div class="text-center">
            <strong>Punteo: </strong> 0 / {{activity.score}}
        </div>

        <div  v-show="studentSendFile == false" class="my-4 mx-auto bg-gray-200 p-6 flex flex-col align-middle">
            <div class="text-center m-8">
                <label><strong>Cargar Archivo: </strong>
                    <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                </label>
            </div>
            <div class="text-center">
                <button v-on:click="submitFile()" class="btn bg-green-500 shadow-lg px-4 py-2 text-white">Entregar</button>
            </div>
        </div>

        <div  v-show="studentSendFile == true"  class="mb-4">
            <div class="iten">
                <svg class="text-center mx-auto text-green-400 font-bold text-lg w-24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h4 class="text-center text-green-400 font-bold text-lg">Tarea Entregada</h4>
            </div>
        </div>

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
        },

        data: function() {
            return {
                file: '',
                studentSendFile: false,
                studentSendFilePath: '',
            }
        },

        mounted() {
           this.getHomework()
        },

        methods: {
            getHomework() {
                axios.get(`/courses/studentHomework/${this.activity.id}`).then(response => {
                    if(response.status == false) {
                        return false
                    }

                    this.studentSendFile = true
                    this.studentSendFilePath = response.file
                })
            },
            /*
               Submits the file to the server
             */
            submitFile(){
                /*
                        Initialize the form data
                    */
                let formData = new FormData();

                /*
                    Add the form data we need to submit
                */
                formData.append('file', this.file);

                /*
                  Make the request to the POST /single-file URL
                */
                axios.post( `/courses/saveStudentHomework/${this.activity.id}`,
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function(){
                    console.log('SUCCESS!!');
                    this.getHomework()
                })
                    .catch(function(){
                        console.log('FAILURE!!');
                    });
            },

            /*
              Handles a change on the file upload
            */
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            }
        }
    }
</script>

<style scoped>

</style>
