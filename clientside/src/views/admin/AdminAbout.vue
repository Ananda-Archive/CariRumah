<template>
    <v-app>
        <v-main app class="mx-4 my-7 mx-md-10 my-md-n5">
            <div>
                <v-row>
                    <v-col cols="12">
                        <h1>Tentang Kami</h1>
                    </v-col>
                    <v-col cols="12">
                        <vue-editor :editorToolbar="document" placeholder="Deskripsi" v-model="about.about"></vue-editor>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            label="Nomor HP Whatsapp"
                            outlined
                            placeholder="87xxxxxx"
                            v-model="about.phone"
                        >
                            <template v-slot:prepend-inner><span class="mr-2 mt-1 primary--text font-weight-bold">+62</span></template>
                        </v-text-field>
                    </v-col>
                    <v-col cols="12" class="text-center mt-n6">
                        <v-btn @click="updateInfo" large dark color="primary">Update</v-btn>
                    </v-col>
                </v-row>
            </div>
        </v-main>
        <v-snackbar
            v-model="snackbar"
            multi-line
            v-bind:color="snackbarColor"
        >
            {{ snackbarMessage }}
            <v-btn
                text
                @click="snackbar = false"
            >
            </v-btn>
        </v-snackbar>
    </v-app>
</template>

<script>

import api from '@/api'
import { VueEditor } from "vue2-editor";

export default {
    components: {
        VueEditor,
    },

    mounted() {
        this.get()
    },

    data() {
        return {
            document: [
                [{ 'header': [false, 1, 2, 3, 4, 5, 6, ] }],
                [{ 'size': ['small', false, 'large', 'huge'] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{'align': ''}, {'align': 'center'}, {'align': 'right'}, {'align': 'justify'}],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'color': [] }, { 'background': [] }],
                ['link'],
                [{ 'direction': 'rtl' }],
                ['clean'],
            ],
            about: {
                id:null,
                about:'',
                phone:''
            },
            snackbarMessage: '',
            snackbarColor: '',
            snackbar: false,
        }
    },

    methods: {
        get() {
            api.getAllAbout()
                .then((response) => {
                    this.about = response[0]
                })
        },
        updateInfo() {
            api.updateAbout(this.about)
                .then((response) => {
                    this.snackbarColor = 'success'
                    this.snackbarMessage = response
                }) .catch(error => {
                    this.snackbarColor = 'error'
                    this.snackbarMessage = error
                }) .finally(() => {
                    this.snackbar = true
                    this.get()
                })
        }
    }
}
</script>

<style>

</style>