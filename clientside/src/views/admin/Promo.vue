<template>
    <v-app>
        <v-main app class="mx-4 my-7 mx-md-10 my-md-n5">
            <div>
                <v-row justify="center">
                    <!-- List -->
                    <v-col cols="12">
                        <v-data-table
                            :headers="promoHeader"
                            :items="promos"
                            style="cursor:pointer"
                            @click:row="editItem"
                        >
                            <template v-slot:[`item.productIndex`]="{ item }">
                                <div class="justify-center">{{promos.indexOf(item)+1}}</div>
                            </template>
                            <template v-slot:[`item.actions`]="{ item }">
                                <!-- <v-icon class="mr-4" @click.stop="editItem(item)">mdi-pencil</v-icon> -->
                                <v-icon @click.stop="confirmDelete(item)">mdi-delete</v-icon>
                            </template>
                            <template v-slot:no-data>
                                <div class="mb-6 mt-md-10"  @click="createDialog = !createDialog">
                                    <v-icon style="font-size:100px">mdi-brightness-percent</v-icon>
                                    <h3 class="mt-3">Belum Ada Promo, Ayo Tambahkan!</h3>
                                </div>
                            </template>
                        </v-data-table>
                    </v-col>
                    <!-- Add -->
                    <v-btn fab dark large color="primary" fixed right bottom @click="createDialog = !createDialog">
                        <v-icon dark>mdi-plus</v-icon>
                    </v-btn>
                    <v-dialog v-model="createDialog" max-width="1100px" persistent>
                        <v-card>
                            <v-toolbar dense flat dark color="primary">
                                <span class="title font-weight-light">Tambah Promo</span>
                                <v-btn absolute right icon @click="close"><v-icon>mdi-close</v-icon></v-btn>
                            </v-toolbar>
                            <v-form ref="form">
                                <v-card-text>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field
                                                outlined
                                                label="Judul"
                                                counter="200"
                                                v-model="promo.title"
                                                :rules="rules.title"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <vue-editor :editorToolbar="document" placeholder="Deskripsi" v-model="promo.content"></vue-editor>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-file-input
                                                v-model="myFiles"
                                                label="Gambar"
                                                prepend-inner-icon="mdi-paperclip"
                                                outlined
                                                :prepend-icon=false
                                                dense
                                                accept="image/png, image/jpeg, image/bmp"
                                                :rules="rules.file"
                                            ></v-file-input>
                                        </v-col>
                                    </v-row>
                                </v-card-text>
                            </v-form>
                            <v-card-actions>
                                <v-container>
                                    <v-row justify="center">
                                        <v-btn :disabled="loadingRegister" class="mt-n12" color="blue darken-1 white--text" @click="create()">
                                            <span v-if="loadingRegister">
                                                <v-progress-circular size="20" :indeterminate="loadingRegister"></v-progress-circular>
                                            </span>
                                            <span v-else>Buat</span>
                                        </v-btn>
                                    </v-row>
                                </v-container>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <!-- Edit -->
                    <v-dialog v-model="editDialog" max-width="1100px" persistent>
                        <v-card>
                            <v-toolbar dense flat dark color="primary">
                                <span class="title font-weight-light">Edit Promo</span>
                                <v-btn absolute right icon @click="close"><v-icon>mdi-close</v-icon></v-btn>
                            </v-toolbar>
                            <v-form ref="form">
                                <v-card-text>
                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field
                                                outlined
                                                label="Judul"
                                                counter="200"
                                                v-model="promo.title"
                                                :rules="rules.title"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <vue-editor :editorToolbar="document" placeholder="Deskripsi" v-model="promo.content"></vue-editor>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-file-input
                                                v-model="myFiles"
                                                label="Gambar"
                                                prepend-inner-icon="mdi-paperclip"
                                                outlined
                                                :prepend-icon=false
                                                dense
                                                accept="image/png, image/jpeg, image/bmp"
                                                :rules="rules.file"
                                            ></v-file-input>
                                        </v-col>
                                        <v-col cols="12" class="mt-n6">
                                            <v-expansion-panels flat hover>
                                                <v-expansion-panel>
                                                    <v-expansion-panel-header>Gambar</v-expansion-panel-header>
                                                    <v-expansion-panel-content>
                                                        <v-row align="center">
                                                            <v-col cols="12">
                                                                <v-card>
                                                                    <v-img :src=promo.image :lazy-src=promo.image >
                                                                        <template v-slot:placeholder>
                                                                            <v-row
                                                                                class="fill-height ma-0"
                                                                                align="center"
                                                                                justify="center"
                                                                            >
                                                                                <v-progress-circular indeterminate color="black"></v-progress-circular>
                                                                            </v-row>
                                                                        </template>
                                                                    </v-img>
                                                                </v-card>
                                                            </v-col>
                                                        </v-row>
                                                    </v-expansion-panel-content>
                                                </v-expansion-panel>
                                            </v-expansion-panels>
                                        </v-col>
                                    </v-row>
                                </v-card-text>
                            </v-form>
                            <v-card-actions>
                                <v-container>
                                    <v-row justify="center">
                                        <v-btn :disabled="loadingRegister" class="mt-n12" color="blue darken-1 white--text" @click="update()">
                                            <span v-if="loadingRegister">
                                                <v-progress-circular size="20" :indeterminate="loadingRegister"></v-progress-circular>
                                            </span>
                                            <span v-else>Update</span>
                                        </v-btn>
                                    </v-row>
                                </v-container>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-row>
            </div>
        </v-main>
        <v-dialog persistent v-model="deleteDialog" width="500px">
            <v-card>
                <v-card-title>Konfirmasi</v-card-title>
                <v-card-text>Apakah Anda Yakin ingin menghapus ini?</v-card-text>
                <v-card-actions>
                    <v-container>
                        <v-row justify="center">
                            <v-btn :disabled="loadingState" class="mt-n5" color="red darken-1" text @click="close">Tidak</v-btn>
                            <v-btn :disabled="loadingState" class="mt-n5" color="blue darken-1" text @click="deletePromo">Ya</v-btn>
                        </v-row>
                    </v-container>
                </v-card-actions>
                    <v-progress-linear v-if="loadingState" color="primary" :indeterminate="loadingState"></v-progress-linear>
            </v-card>
        </v-dialog>
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

import api from '@/api.js'
import firebase from 'firebase';
import _ from 'lodash'
import { VueEditor } from "vue2-editor";

export default {

    components: {
        VueEditor,
    },

    data() {
        return {
            loadingRegister:false,
            myFiles:[],
            promos:[],
            promo:{
                id:null,
                title:'',
                content:'',
                image:''
            },
            promoDefault:{
                id:null,
                title:'',
                content:'',
                image:''
            },
            // Rules Goes Here
            rules: {
                title: [
                    v => !!v || 'Judul Harus Diisi',
                    v => v.length <=200 || 'Maksimal 200 Karakter'
                ],
                file: [
                    v => !!v || 'File is required',
                ]
            },
            document: [
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
            createDialog: false,
            snackbarMessage: '',
            snackbarColor: '',
            snackbar: false,
            editDialog: false,
            deleteDialog: false,
        }
    },

    mounted() {
        if(this.uid) {
            this.$router.push('/Promo')
        } else {
            this.$router.push('/login')
        }
        this.get()
    },

    methods: {
        close() {
            this.selectedIndex = -1
            this.createDialog = false
            this.editDialog = false
            this.deleteDialog = false
            this.promo = _.cloneDeep(this.promoDefault)
            this.myFiles = []
        },
        get() {
            api.getAllPromo()
                .then((response) => {
                    this.promos = response
                })
        },
        editItem(item) {
            this.selectedIndex = this.promos.indexOf(item)
            this.promo = _.cloneDeep(item)
            this.editDialog = true
        },
        confirmDelete(item) {
            this.selectedIndex = this.promos.indexOf(item)
            this.promo = _.cloneDeep(item)
            this.deleteDialog = true
        },
        addImage(file) {
            return new Promise((resolve, reject) => {
                var storageRef = firebase.storage().ref('promo/'+Math.random() + '_'  + file.name)
                storageRef.put(file)
                .then((snapshot) => {
                    resolve(snapshot.ref.getDownloadURL())
                })
                .catch((err) => {
                    reject(err)
                })
            })
        },
        deleteImage(imageFile) {
            return new Promise((resolve, reject) => {
                let image = firebase.storage().refFromURL(imageFile)
                image.delete()
                .then(() => {
                    resolve()
                }) .catch((err) => {
                    reject(err)
                })
            })
        },
        async create() {
            if(this.$refs.form.validate()) {
                this.loadingRegister = true
                await this.addImage(this.myFiles)
                    .then((response) => {
                        this.promo.image = response
                    }) .catch(() => {
                        console.log(this.myFiles)
                    })
                api.createPromo(this.promo)
                    .then((response) => {
                        this.snackbarColor = 'success'
                        this.snackbarMessage = response
                    }) .catch(error => {
                        this.snackbarColor = 'error'
                        this.snackbarMessage = error
                    }) .finally(() => {
                        this.snackbar = true
                        this.close()
                        this.get()
                        this.loadingRegister = false
                    })
            }
        },
        async update() {
            if(this.$refs.form.validate()) {
                this.loadingRegister = true
                if(this.myFiles.length != 0) {
                    await this.addImage(this.myFiles)
                        .then((response) => {
                            this.promo.image = response
                        }) .catch(() => {
                            console.log(this.myFiles)
                        })
                }
                api.updatePromo(this.promo)
                    .then((response) => {
                        this.snackbarColor = 'success'
                        this.snackbarMessage = response
                    }) .catch(error => {
                        this.snackbarColor = 'error'
                        this.snackbarMessage = error
                    }) .finally(() => {
                        this.snackbar = true
                        this.close()
                        this.get()
                        this.loadingRegister = false
                    })
            }
        },
        async deletePromo() {
            this.loadingRegister = true
            await this.deleteImage(this.promo.image)
                .then((response) => {
                    console.log(response)
                })
                .catch((err) => {
                    console.log(err)
                })
            api.deletePromo(this.promo.id)
                .then((response) => {
                    this.snackbarColor = 'success'
                    this.snackbarMessage = response
                }) .catch(error => {
                    this.snackbarColor = 'error'
                    this.snackbarMessage = error
                }) .finally(() => {
                    this.snackbar = true
                    this.close()
                    this.get()
                    this.loadingRegister = false
                })
        }
    },

    computed: {
        uid() {
            return this.$store.state.uid
        },
        promoHeader() {
            if(this.promos.length > 0) {
                return [
                    {text:'No', value:'productIndex', width:'5%', align:'center'},
                    {text:'Nama', value:'title'},
                    {value:'actions', width:'10%'}
                ]
            } return []
        }
    },

    watch: {
        close() {
            this.$refs.form.resetValidation()
        },
        createDialog() {
            this.$refs.form.resetValidation()
        },
        editDialog() {
            this.$refs.form.resetValidation()
        }
    }
}
</script>

<style>
.filepond--file-action-button {
    cursor: pointer;
}
.filepond--drop-label {
    color: white;
}
.filepond--panel-root {
    background-color: rgba(31, 31, 31, 0.8);
}
.filepond--file-action-button {
    background-color: white;
    color: red;
}
.filepond--item-panel {
    background-color: green;
}
.filepondFormatText {
    font-size: 12px !important;
    display: block;
}
.v-dialog > .v-card > .v-toolbar {
  position: sticky;
  top: 0;
  z-index: 999;
}
</style>