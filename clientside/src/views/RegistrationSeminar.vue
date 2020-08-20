<template>
    <v-app>
        <v-content class="ma-12">
            <v-container fluid>
                <v-form ref="form">
                    <v-row>
                        <v-col cols="12">
                            <h1 class="font-weight-medium">DAFTAR SEMINAR</h1>
                            <v-divider></v-divider>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                v-model="data.name"
                                label="Nama"
                                outlined
                                :rules="rules.name"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="6" class="mt-n6">
                            <v-text-field
                                v-model="data.phoneNumber"
                                label="Nomor yang bisa dihubungi"
                                outlined
                                :rules="rules.phoneNumber"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="6" class="mt-n6">
                            <v-text-field
                                v-model="data.email"
                                label="Email"
                                outlined
                                :rules="rules.email"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" class="mt-n6">
                            <v-textarea
                                v-model="data.ownerAddress"
                                label="Alamat Pendaftar"
                                outlined
                                :rules="rules.ownerAddress"
                            ></v-textarea>
                        </v-col>
                        <v-col cols="12">
                            <file-pond
                                :allowDrop="!loadingState"
                                :allowBrowse="!loadingState"
                                style="cursor: pointer"
                                name="test"
                                ref="pond"
                                label-idle="<span class='filepondFormatText'>Upload Gambar Bukti Pembayaran </span><span class='filepondFormatText'>Format: JPG/PNG</span>"
                                v-bind:files="myFiles"
                                instant-upload="false"
                                v-on:updatefiles="handleFilePondUpdateFile"
                                labelInvalidField="remove"
                                allow-multiple="true"
                                max-files="1"
                                accepted-file-types="image/*"
                                fileValidateTypeLabelExpectedTypes="Hanya menerima format JPG dan PNG"
                            />
                        </v-col>
                        <v-col cols="12" class="text-center">
                            <v-btn :disabled="disabledFunc" class="blue white--text" x-large width="10%" @click="send">Daftar</v-btn>
                        </v-col>
                    </v-row>
                </v-form>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>

import api from '@/api'
import vueFilePond from 'vue-filepond'
import 'filepond/dist/filepond.min.css'
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type'
// import axios from 'axios'

const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
)

export default {
    components: {
        FilePond
    },
    data() {
        return {
            myFiles: [],
            data: {
                name:'',
                phoneNumber:'',
                email:'',
                ownerAddress:'',
                address:'',
                area:'',
                specification:''
            },
            phone:'',
            rules: {
                name: [
                    v => !!v || 'Nama Harus Diisi',
                    v => v.length <50 || 'Maksimal 50 Karakter'
                ],
                phoneNumber: [
                    v => !!v || 'Nomor Harus Diisi'
                ],
                email: [
                    v => !!v || 'Lokasi Harus Diisi',
                    v => /.+@.+\..+/.test(v) || 'E-mail Tidak Valid',
                ],
                ownerAddress: [
                    v => !!v || 'Alamat Pendaftar Harus Diisi'
                ],
                address: [
                    v => !!v || 'Alamat Harus Diisi'
                ],
                area: [
                    v => !!v || 'Luas Bangunan Harus Diisi',
                    v => v >= 0 || 'Luas Bangunan Tidak Valid'
                ],
                specification: [
                    v => !!v || 'Spesifikasi Harus Diisi',
                ],
            },
            loadingState:false
        }
    },

    mounted() {
        api.getAllAbout() 
            .then((response) => {
                this.phone = response[0].phone
            })
    },

    methods: {
        send() {
            if(this.$refs.form.validate()) {
                this.loadingState = true
                api.uploadImage(this.myFiles[0])
                    .then((response) => {
                        window.open('https://api.whatsapp.com/send?phone=+62'+this.phone+'&text=[Daftar Seminar]%0aNama: '+this.data.name+'%0aNomor Yang Bisa Dihubungi: '+this.data.phoneNumber+'%0aEmail: '+this.data.email+'%0aAlamat Pendaftar: '+this.data.ownerAddress+'%0aBukti Pendaftaran: '+response.message);
                    })
                    .catch((err) => {
                        console.log(err)
                    })
                    .finally(() => {
                        this.loadingState = false
                    })
            }
        },
        handleFilePondUpdateFile(files) {
            this.myFiles = files.map(files => files.file);
        },
    },

    computed: {
        disabledFunc() {
            if(this.loadingState) {
                return true
            }
            if(this.myFiles.length == 0) {
                return true
            }
            return false
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
</style>