<template>
    <div>
        <div class="activity-header flex items-center">
            <div class="flex-1">
                <h1 class="text-2xl text-gray-800">
                    {{ activity.name }}
                </h1>
            </div>
        </div>

        <div class="bg-yellow-200 text-center p-2 shadow-lg">
            <p>
                <strong>Último  día para entrega: </strong> {{ activity.end }}
            </p>
        </div>
        <div class="mt-4" v-html="activity.activityable.html">
        </div>

        <div class="flex items-center justify-center mt-8 w-full">
            <a
                v-if="activity.activityable.file != null"
                class="bg-blue-100 px-6 py-4 shadow rounded-lg font-bold"
                :href="`/storage/${activity.activityable.file}`"
                target="_blank"
            >Descargar Documento Adjunto</a>
        </div>

        <div class="text-center">
            <strong>Punteo: </strong> {{ studentScore }} / {{activity.score}}
            <div class="mx-4 p-4 bg-green-100 shadow-lg" v-if="studentScoreComment != '' ">
                {{ studentScoreComment }}
            </div>
        </div>

        <div  v-if="studentSendFile == false" class="mt-4 mx-auto bg-gray-100 p-6 flex flex-col align-middle">
            <h1 class="text-2xl font-bold" style="color:#193660">
                Entrega de tarea:
            </h1>

            <div class="bg-white border border-gray-400 shadow-lg mt-4">
                <div id="editorjs"></div>
            </div>

            <div class="text-center m-8">
                <label><strong>Cargar Archivo: </strong>
                    <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                </label>
            </div>
            <div class="text-center">
                <button v-on:click="submitFile()" class="btn bg-green-500 shadow-lg px-4 py-2 text-white">Entregar</button>
            </div>
        </div>

        <div  v-show="studentSendFile == true"  class="mb-4 mt-4">
            <div class="iten">
                <svg class="text-center mx-auto text-green-400 font-bold text-lg w-24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            <div>
                <h4 class="text-center text-green-400 font-bold text-lg">Tarea Entregada</h4>
            </div>

            <div class="text-center text-gray-400 font-bold text-sm mt-4">
                <a :href="`/storage/${studentSendFilePath}`"  target="_blank"  download>
                    <div class="flex m-auto justify-center items-center">
                       <div class="flex-shrink">
                           <svg class="w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                           </svg>
                       </div>

                        <div class="ml-2">
                            Descargar mi archivo
                        </div>
                    </div>
                </a>


                <div class="flex justify-end text-red-400 font-bold text-xs mt-4">
                    <button @click="deleteHomework()">
                        <div class="flex m-auto justify-end item-center">
                            <div class="flex-shrink">
                                <svg class="w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </div>

                            <div class="ml-2">
                                Eliminar entrega de tarea
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </div>

        <comments :activity="activity" :user="user"></comments>

        <div
            v-if="isLoaded"
            class="absolute top-0 left-0 w-screen h-screen bg-white flex items-center justify-center">
                <div class="flex-shrink h-64 inline-block align-middle">
                    <div class=" flex justify-center items-center">
                        <div class="animate-spin rounded-full h-32 w-32 border-b-2 border-blue-900"></div>
                    </div>
                    <div class="mt-4">
                        Cargando archivo, por favor espere
                    </div>
                </div>
        </div>
    </div>
</template>

<script>
    import Comments from "../Comments";
    import Button from "../../../Jetstream/Button";
    import EditorJS from '@editorjs/editorjs';
    import Underline from '@editorjs/underline';
    import NestedList from '@editorjs/nested-list';


    const Table = require('@editorjs/table');
    const Header = require('@editorjs/header');
    const SimpleImage = require('@editorjs/simple-image');
    const AttachesTool = require('@editorjs/attaches');

    export default {
        components: {
            Button,
            Comments,
        },

        props: {
            activity: Object,
            user: Object,
        },

        data: function() {
            return {
                isLoaded: false,
                file: '',
                studentScore: 0,
                studentScoreComment: '',
                studentSendFile: false,
                studentSendFilePath: '',
                editor: Object,
                tools: {
                    table: {
                        class: Table,
                    },
                    header: Header,
                    underline: Underline,
                    list: {
                        class: NestedList,
                        inlineToolbar: true,
                    },
                    image: SimpleImage,
                    attaches: {
                        class: AttachesTool,
                        config: {
                            endpoint: '/editorjs/uploadFile'
                        }
                    }
                }
            }
        },

        mounted() {
            this.getHomework()
            /*this.editor = new EditorJS({
                holder: 'editorjs',
                tools: this.tools,
            })*/
        },

        updated() {
            this.getHomework()
        },

        methods: {
            getHomework() {
                console.log(this.activity.id)
                axios.get(`/courses/studentHomework/${this.activity.id}`).then(response => {
                    if(response.data.status == false) {
                        this.studentSendFile = false
                        this.studentSendFilePath = ''
                        return false
                    }

                    this.studentSendFile = true
                    this.studentSendFilePath = response.data.file
                    this.studentScore = response.data.score
                    this.studentScoreComment = response.data.comment
                })
            },

            deleteHomework() {
                let confirm = window.confirm("Estas a punto de eliminar la entrega de tu tarea!")

                if(confirm == false) {
                    return false;
                }

                axios.get(`/courses/studentDeleteHomework/${this.activity.id}`).then(response => {
                    this.getHomework()
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
                ).then(response => {
                    console.log('SUCCESS!!');
                    //this.isLoaded = false
                    this.getHomework()
                })
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
