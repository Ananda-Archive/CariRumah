<template>
    <v-app>
        <v-content app class="mx-4 my-7 mx-md-10 my-md-n5">
            <div>
                <v-row justify="center">
                    <!-- Search Feature -->
                    <v-col cols="12">
                        <v-text-field
                            outlined
                            dense
                            v-model="advanceSearch.name"
                            label="Cari Data"
                            prepend-inner-icon="mdi-magnify"
                            :clearable="true"
                            @click:clear="advanceSearch.name = ''"
                        ></v-text-field>
                    </v-col>
                    <!-- List -->
                    <v-col cols="12">
                        <v-data-table
                            v-if="!breakPoint"
                            :headers="productHeader"
                            :items="products"
                            style="cursor:pointer"
                        >
                            <template v-slot:item.productIndex="{ item }">
                                <div class="justify-center">{{products.indexOf(item)+1}}</div>
                            </template>
                            <template v-slot:item.actions="{ item }">
                                <v-icon class="mr-4" @click.stop="editItem(item)">mdi-pencil</v-icon>
                                <v-icon @click.stop="confirmDelete(item)">mdi-delete</v-icon>
                            </template>
                            <template v-slot:no-data>
                                <div class="mb-6 mt-md-10"  @click="createDialog = !createDialog">
                                    <v-icon style="font-size:100px">mdi-folder-home-outline</v-icon>
                                    <h3 class="mt-3">Belum Ada Data Produk, Ayo Tambahkan!</h3>
                                </div>
                            </template>
                            <template v-slot:no-results>
                                <div class="mb-6 mt-md-10">
                                    <v-icon style="font-size:100px">mdi-home-search-outline</v-icon>
                                    <h3 class="mt-3">Produk yang Anda Cari Tidak Ditemukan</h3>
                                    <div class="mt-3">
                                        <v-icon>mdi-emoticon-sad-outline</v-icon>
                                        <v-icon>mdi-emoticon-sad-outline</v-icon>
                                        <v-icon>mdi-emoticon-sad-outline</v-icon>
                                    </div>
                                </div>
                            </template>
                        </v-data-table>
                        <v-data-table
                            v-else
                            :headers="productHeader"
                            :items="products"
                            style="cursor:pointer"
                            :disable-sort="true"
                            :hide-default-header="true"
                            class="mb-12 pb-4"
                        >
                            <template v-slot:item="{item}">
                                <v-card class="mt-1 mb-3 mx-2 pa-2" color="primary" dark outlined>
                                    <div class="d-flex flex-no-wrap justify-space-between align-center">
                                        <div>
                                            <v-card-title class="body-2">{{products.indexOf(item)+1}}. {{ item.name }}</v-card-title>
                                        </div>
                                        <div class="mt-n2">
                                            <v-menu
                                                :close-on-click="true"
                                                :close-on-content-click="true"
                                                :offset-y="true"
                                            >
                                                <template v-slot:activator="{ on }">
                                                    <v-card-actions><v-icon v-on="on">mdi-dots-vertical</v-icon></v-card-actions>
                                                </template>
                                                <v-list>
                                                    <v-list-item @click.stop="editItem(item)">
                                                        <v-list-item-title>Edit Produk</v-list-item-title>
                                                    </v-list-item>
                                                    <v-list-item @click.stop="confirmDelete(item)">
                                                        <v-list-item-title>Hapus Produk</v-list-item-title>
                                                    </v-list-item>
                                                </v-list>
                                            </v-menu>
                                        </div>
                                    </div>
                                </v-card>
                            </template>
                            <template v-slot:no-data>
                                <div class="mb-6 mt-md-10"  @click="createDialog = !createDialog">
                                    <v-icon style="font-size:100px">mdi-folder-home-outline</v-icon>
                                    <h3 class="mt-3">Belum Ada Data Produk, Ayo Tambahkan!</h3>
                                </div>
                            </template>
                            <template v-slot:no-results>
                                <div class="mb-6 mt-md-10">
                                    <v-icon style="font-size:100px">mdi-home-search-outline</v-icon>
                                    <h3 class="mt-3">Produk yang Anda Cari Tidak Ditemukan</h3>
                                    <div class="mt-3">
                                        <v-icon>mdi-emoticon-sad-outline</v-icon>
                                        <v-icon>mdi-emoticon-sad-outline</v-icon>
                                        <v-icon>mdi-emoticon-sad-outline</v-icon>
                                    </div>
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
                                <span class="title font-weight-light">Tambah Produk</span>
                                <v-btn absolute right icon @click="close"><v-icon>mdi-close</v-icon></v-btn>
                            </v-toolbar>
                            <v-form ref="form">
                                <v-card-text>
                                    <v-row>
                                        <v-col cols="12" sm="12" md="6" class="mt-2">
                                            <v-text-field
                                                v-model="product.name"
                                                label="Nama Produk"
                                                outlined
                                                :rules="rules.name"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6" class="mt-n6 mt-md-2">
                                            <v-select
                                                outlined
                                                label="Jenis Properti"
                                                v-model="product.property"
                                                :items="productProperty"
                                                item-text="name"
                                                item-value="id"
                                                :clearable="true"
                                                @click:clear="product.property = null"
                                                :rules="rules.property"
                                            >
                                            </v-select>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6" class="mt-n6">
                                            <v-text-field
                                                v-model="product.price"
                                                label="Harga"
                                                outlined
                                                :rules="rules.price"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6" class="mt-n6">
                                            <v-select
                                                v-model="product.productCondition"
                                                label="Kondisi"
                                                outlined
                                                :items="productCondition"
                                                item-text="name"
                                                item-value="id"
                                                :clearable="true"
                                                @click:clear='product.productCondition = null'
                                                :rules="rules.productCondition"
                                            >
                                            </v-select>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6" class="mt-n6">
                                            <v-text-field
                                                v-model="product.lt"
                                                outlined
                                                :rules="rules.lt"
                                            >
                                                <template v-slot:label>Luas Tanah (m<sup>2</sup>)</template>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6" class="mt-n6">
                                            <v-text-field
                                                v-model="product.lb"
                                                outlined
                                                :rules="rules.lb"
                                            >
                                                <template v-slot:label>Luas Bangunan (m<sup>2</sup>)</template>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6" class="mt-n6">
                                            <v-autocomplete
                                                outlined
                                                label="Lokasi"
                                                v-model="product.location"
                                                :items="getProvince"
                                                item-text="nama"
                                                item-value="nama"
                                                :search-input.sync="filterSyncLocation"
                                                :clearable="true"
                                                :auto-select-first="true"
                                                :readonly="product.location != null"
                                                @click:clear='product.location = null'
                                                :rules="rules.location"
                                            >
                                            </v-autocomplete>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6" class="mt-n6">
                                            <v-text-field
                                                v-model="product.contactPerson"
                                                outlined
                                                label="Contact Person"
                                                :rules="rules.contactPerson"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" class="mt-n6">
                                            <vue-editor :rules="rules.facility" :editorToolbar="customToolbar.facility" placeholder="Fasilitas" v-model="product.facility"></vue-editor>
                                        </v-col>
                                        <v-col cols="12">
                                            <vue-editor :rules="rules.document" :editorToolbar="customToolbar.document" placeholder="Deskripsi" v-model="product.document"></vue-editor>
                                        </v-col>
                                        <v-col cols="12">
                                            <file-pond
                                                :allowDrop="!loadingState"
                                                :allowBrowse="!loadingState"
                                                style="cursor: pointer"
                                                name="test"
                                                ref="pond"
                                                label-idle="<span class='filepondFormatText'>Upload Gambar </span><span class='filepondFormatText'>Format: JPG/PNG</span>"
                                                v-bind:files="myFiles"
                                                instant-upload="false"
                                                v-on:updatefiles="handleFilePondUpdateFile"
                                                labelInvalidField="remove"
                                                allow-multiple="true"
                                                accepted-file-types="image/*"
                                                fileValidateTypeLabelExpectedTypes="Hanya menerima format JPG dan PNG"
                                            />
                                        </v-col>
                                    </v-row>
                                </v-card-text>
                            </v-form>
                            <v-card-actions>
                                <v-container>
                                    <v-row justify="center">
                                        <v-btn :disabled="buttonStatus" large class="mt-n8" color="blue darken-1 white--text" @click="create">
                                            <span v-if="loadingState">
                                                <v-progress-circular size="20" :indeterminate="loadingState"></v-progress-circular>
                                            </span>
                                            <span v-else>Tambah Produk</span>
                                        </v-btn>
                                    </v-row>
                                </v-container>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <!-- Update -->
                    <v-dialog v-model="updateDialog" max-width="1100px" persistent>
                        <v-card>
                            <v-toolbar dense flat dark color="primary">
                                <span class="title font-weight-light">Edit Produk</span>
                                <v-btn absolute right icon @click="close"><v-icon>mdi-close</v-icon></v-btn>
                            </v-toolbar>
                            <v-form ref="form">
                                <v-card-text>
                                    <v-row>
                                        <v-col cols="12" class="mt-2">
                                            <v-select
                                                v-model="product.status"
                                                label="Status Produk"
                                                outlined
                                                :items="productStatus"
                                                item-text="name"
                                                item-value="id"
                                            ></v-select>
                                        </v-col>
                                        <v-col cols="12" class="mt-n6">
                                            <v-text-field
                                                v-model="product.name"
                                                label="Nama Produk"
                                                outlined
                                                :rules="rules.name"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6" class="mt-n6">
                                            <v-text-field
                                                v-model="product.price"
                                                label="Harga"
                                                outlined
                                                :rules="rules.price"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6" class="mt-n6">
                                            <v-select
                                                v-model="product.productCondition"
                                                label="Kondisi"
                                                outlined
                                                :items="productCondition"
                                                item-text="name"
                                                item-value="id"
                                                :clearable="true"
                                                @click:clear='product.productCondition = null'
                                                :rules="rules.productCondition"
                                            >
                                            </v-select>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6" class="mt-n6">
                                            <v-text-field
                                                v-model="product.lt"
                                                outlined
                                                :rules="rules.lt"
                                            >
                                                <template v-slot:label>Luas Tanah (m<sup>2</sup>)</template>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6" class="mt-n6">
                                            <v-text-field
                                                v-model="product.lb"
                                                outlined
                                                :rules="rules.lb"
                                            >
                                                <template v-slot:label>Luas Bangunan (m<sup>2</sup>)</template>
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6" class="mt-n6">
                                            <v-autocomplete
                                                outlined
                                                label="Lokasi"
                                                v-model="product.location"
                                                :items="getProvince"
                                                item-text="nama"
                                                item-value="nama"
                                                :search-input.sync="filterSyncLocation"
                                                :clearable="true"
                                                :auto-select-first="true"
                                                :readonly="product.location != null"
                                                @click:clear='product.location = null'
                                                :rules="rules.location"
                                            >
                                            </v-autocomplete>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="6" class="mt-n6">
                                            <v-text-field
                                                v-model="product.contactPerson"
                                                outlined
                                                label="Contact Person"
                                                :rules="rules.contactPerson"
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" class="mt-n6">
                                            <vue-editor :rules="rules.facility" :editorToolbar="customToolbar.facility" placeholder="Fasilitas" v-model="product.facility"></vue-editor>
                                        </v-col>
                                        <v-col cols="12">
                                            <vue-editor :rules="rules.document" :editorToolbar="customToolbar.document" placeholder="Deskripsi" v-model="product.document"></vue-editor>
                                        </v-col>
                                        <v-col cols="12">
                                            <file-pond
                                                :allowDrop="!loadingState"
                                                :allowBrowse="!loadingState"
                                                style="cursor: pointer"
                                                name="test"
                                                ref="pond"
                                                label-idle="<span class='filepondFormatText'>Upload Gambar </span><span class='filepondFormatText'>Format: JPG/PNG</span>"
                                                v-bind:files="myFiles"
                                                instant-upload="false"
                                                v-on:updatefiles="handleFilePondUpdateFile"
                                                labelInvalidField="remove"
                                                allow-multiple="true"
                                                accepted-file-types="image/*"
                                                fileValidateTypeLabelExpectedTypes="Hanya menerima format JPG dan PNG"
                                            />
                                        </v-col>
                                        <v-col cols="12">
                                            <v-expansion-panels v-model="panel" flat hover>
                                                <v-expansion-panel>
                                                    <v-expansion-panel-header>Gambar</v-expansion-panel-header>
                                                    <v-expansion-panel-content>
                                                        <v-row align="center">
                                                            <v-col cols="12" sm="12" md="4" v-for="(img, idx) in product.images" :key="idx">
                                                                <v-card>
                                                                    <v-img :src=img :lazy-src=img height="300px">
                                                                        <template v-slot:placeholder>
                                                                            <v-row
                                                                                class="fill-height ma-0"
                                                                                align="center"
                                                                                justify="center"
                                                                            >
                                                                                <v-progress-circular indeterminate color="black"></v-progress-circular>
                                                                            </v-row>
                                                                        </template>
                                                                        <v-col cols="12" class="text-right"><v-btn icon class="red--text" style="background-color:rgba(255,255,255,.5)" small @click="moveTrash(img)"><v-icon>mdi-close</v-icon></v-btn></v-col>
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
                                        <v-btn :disabled="buttonStatus" large class="mt-n8" color="blue darken-1 white--text" @click="update">
                                            <span v-if="loadingState">
                                                <v-progress-circular size="20" :indeterminate="loadingState"></v-progress-circular>
                                            </span>
                                            <span v-else>Update Produk</span>
                                        </v-btn>
                                    </v-row>
                                </v-container>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-row>
            </div>
        </v-content>
        <v-dialog persistent v-model="confirmDeleteDialog" width="500px">
            <v-card>
                <v-card-title>Konfirmasi</v-card-title>
                <v-card-text>Apakah Anda Yakin ingin menghapus ini?</v-card-text>
                <v-card-actions>
                    <v-container>
                        <v-row justify="center">
                            <v-btn :disabled="loadingState" class="mt-n5" color="red darken-1" text @click="close">Tidak</v-btn>
                            <v-btn :disabled="loadingState" class="mt-n5" color="blue darken-1" text @click="deleteItem">Ya</v-btn>
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
import vueFilePond from 'vue-filepond'
import 'filepond/dist/filepond.min.css'
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type'

const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
)

export default {
    name: 'Dashboard',

    components: {
        VueEditor,
        FilePond
    },

    data() {
        return {
            snackbarMessage: '',
            snackbarColor: '',
            advanceSearch: {
                name:''
            },
            productCondition: [
                {
                    id:"1",
                    name:'Baru'
                },
                {
                    id:"2",
                    name:'Bekas'
                }
            ],
            productStatus: [
                {
                    id:"1",
                    name:'Belum Terjual'
                },
                {
                    id:"2",
                    name:'Terjual'
                }
            ],
            productProperty: [
                {
                    id:1,
                    name:'Perumahan'
                },
                {
                    id:2,
                    name:'Rumah Dijual'
                },
                {
                    id:3,
                    name:'Tanah Dijual'
                },
                {
                    id:4,
                    name:'Rumah Disewakan'
                },
                {
                    id:5,
                    name:'Tanah Disewakan'
                },
                {
                    id:6,
                    name:'Jual Kos'
                },
                {
                    id:7,
                    name:'Sewa Kos'
                }
            ],
            filterSyncLocation:'',
            customToolbar: {
                facility: [
                    ['bold', 'italic', 'underline', 'strike'],
                    [{'align': ''}, {'align': 'center'}, {'align': 'right'}, {'align': 'justify'}],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
                    [{ 'script': 'sub'}, { 'script': 'super' }],
                    ['clean'],
                ],
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
                ]
            },
            selectedIndex:-1,
            selectedIndexImg:-1,
            selectedImages:[],
            panel:1,
            // Object For CRUD Goes Here
            products:[],
            myFiles:[],
            product: {
                id:null,
                name:'',
                price:'',
                location:null,
                lb:'',
                lt:'',
                productCondition:'',
                facility:null,
                document:null,
                contactPerson:'',
                status:null,
                porperty:null,
                images:[]
            },
            productDefault: {
                id:null,
                name:'',
                price:'',
                location:null,
                lb:'',
                lt:'',
                productCondition:'',
                facility:null,
                document:null,
                contactPerson:'',
                status:null,
                porperty:null,
                images:[]
            },
            // Rules Goes Here
            rules: {
                name: [
                    v => !!v || 'Nama Harus Diisi',
                    v => v.length <200 || 'Maksimal 200 Karakter'
                ],
                price: [
                    v => !!v || 'Harga Harus Diisi'
                ],
                location: [
                    v => !!v || 'Lokasi Harus Diisi'
                ],
                lb: [
                    v => !!v || 'Luas Bangunan Harus Diisi',
                    v => v >= 0 || 'Luas Bangunan Tidak Valid'
                ],
                lt: [
                    v => !!v || 'Luas Tanah Harus Diisi',
                    v => v >= 0 || 'Luas Tanah Tidak Valid'
                ],
                productCondition: [
                    v => !!v || 'Kondisi Harus Diisi',
                ],
                facility: [
                    v => !!v || 'Fasilitas Harus Diisi',
                ],
                document: [
                    v => !!v || 'Deskripsi Harus Diisi',
                ],
                contactPerson: [
                    v => !!v || 'Kontak Harus Diisi'
                ],
                property: [
                    v => !!v || 'Jenis Properti Harus Diisi'
                ]
            },
            // Dialog State Goes Here
            createDialog:false,
            updateDialog:false,
            confirmDeleteDialog:false,
            loadingState:false,
            snackbar: false,
        }
    },

    mounted() {
        this.get()
    },

    methods: {
        // Filter
        advanceSearchName(val) {
            if(!this.advanceSearch.name) {
                return true
            }
            return val.toLowerCase().includes(this.advanceSearch.name.toLowerCase())
        },
        handleFilePondUpdateFile(files) {
            this.myFiles = files.map(files => files.file);
        },
        close() {
            this.createDialog = false
            this.updateDialog = false
            this.confirmDeleteDialog = false
            this.selectedIndex = -1
            this.product = _.cloneDeep(this.productDefault)
            this.myFiles = []
            this.panel = 1
            this.selectedIndexImg = -1
            this.selectedImages = []
        },
        // Firebase API
        uploadImg(imgFile) {
            return new Promise((resolve, reject) => {
                var storageRef = firebase.storage().ref('product/'+Math.random() + '_'  + imgFile.name) 
                storageRef.put(imgFile)
                .then((snapshot) => {
                    resolve(snapshot.ref.getDownloadURL())
                })
                .catch((err) => {
                    reject(err)
                })
            })
        },
        // Create Product
        async create() {
            if(this.$refs.form.validate()) {
                this.loadingState = true
                for(let i=0; i<this.myFiles.length; i++) {
                    await this.uploadImg(this.myFiles[i])
                        .then((response) => {
                            this.product.images.push(response)
                        })
                        .catch((err) => {
                            console.log(err)
                        })
                }
                api.createProduct(this.product)
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
                        this.loadingState = false
                    })
            }
        },
        // Get Products
        get() {
            api.getAllProduct()
                .then((response) => {
                    this.products = response
                })
        },
        editItem(item) {
            this.selectedIndex = this.products.indexOf(item)
            this.product = _.cloneDeep(item)
            const a = []
            this.product.images.forEach(e => {
                a.push(e.image)
            });
            this.product.images = a
            this.updateDialog = true
        },
        // Update
        async update() {
            if(this.$refs.form.validate()) {
                this.loadingState = true
                for(let i=0; i<this.myFiles.length; i++) {
                    await this.uploadImg(this.myFiles[i])
                        .then((response) => {
                            this.product.images.push(response)
                        })
                        .catch((err) => {
                            console.log(err)
                        })
                }
                for(let i=0; i<this.selectedImages.length; i++) {
                    await this.deleteImage(this.selectedImages[i])
                        .then((response) => {
                            console.log(response)
                        })
                        .catch((err) => {
                            console.log(err)
                        })
                }
                api.updateProduct(this.product)
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
                        this.loadingState = false
                    })
            }
        },
        // Delete
        moveTrash(img) {
            this.selectedIndexImg = this.product.images.indexOf(img)
            this.selectedImages.push(img)
            this.product.images.splice(this.selectedIndexImg, 1)
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
        confirmDelete(item) {
            this.selectedIndex = this.products.indexOf(item)
            this.product = _.cloneDeep(item)
            const a = []
            this.product.images.forEach(e => {
                a.push(e.image)
            });
            this.product.images = a
            this.product.images.forEach(e => {
                this.selectedImages.push(e)
            });
            this.product.images = []
            this.confirmDeleteDialog = true
        },
        async deleteItem() {
            this.loadingState = true
            for(let i=0; i<this.selectedImages.length; i++) {
                await this.deleteImage(this.selectedImages[i])
                    .then((response) => {
                        console.log(response)
                    })
                    .catch((err) => {
                        console.log(err)
                    })
            }
            api.deleteProduct(this.product.id)
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
                    this.loadingState = false
                })
        }
    },

    computed: {
        breakPoint() {
            if (this.$vuetify.breakpoint.name == 'xs') {
                return true
            } else {
                return false
            }
        },
        getProvince() {
            return this.$store.state.province.province
        },
        productHeader() {
            if(this.products.length > 0) {
                return [
                    {text:'No', value:'productIndex', width:'5%', align:'center'},
                    {text:'Nama', value:'name', filter:this.advanceSearchName},
                    {value:'actions', width:'10%'}
                ]
            } return []
        },
        buttonStatus() {
            if(this.loadingState) {
                return true
            } else {
                for(let i=0; i<this.myFiles.length; i++) {
                    if(this.myFiles[i]['type'] === 'image/png' || this.myFiles[i]['type'] === 'image/jpeg' || this.myFiles[i]['type'] === 'image/jpg') {
                        return false
                    } else {
                        return true
                    }
                }
            }
            return false
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