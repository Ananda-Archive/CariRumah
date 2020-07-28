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
                            v-model="search"
                            label="Cari Data"
                            prepend-inner-icon="mdi-magnify"
                            :clearable="true"
                            @click:clear="search = ''"
                        ></v-text-field>
                    </v-col>
                    <!-- List -->
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
                            <v-card-text>
                                <v-row>
                                    <v-col cols="12" class="mt-2">
                                        <v-text-field
                                            v-model="product.name"
                                            label="Nama Produk"
                                            outlined
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="12" md="6" class="mt-n6">
                                        <v-text-field
                                            v-model="product.price"
                                            label="Harga"
                                            outlined
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="12" md="6" class="mt-n6">
                                        <v-select
                                            v-model="product.condition"
                                            label="Kondisi"
                                            outlined
                                            :items="condition"
                                            item-text="name"
                                            item-value="id"
                                            :clearable="true"
                                            @click:clear='product.condition = null'
                                        >
                                        </v-select>
                                    </v-col>
                                    <v-col cols="12" sm="12" md="6" class="mt-n6">
                                        <v-text-field
                                            v-model="product.lt"
                                            outlined
                                        >
                                            <template v-slot:label>Luas Tanah (m<sup>2</sup>)</template>
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="12" md="6" class="mt-n6">
                                        <v-text-field
                                            v-model="product.lb"
                                            outlined
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
                                        >
                                        </v-autocomplete>
                                    </v-col>
                                    <v-col cols="12" sm="12" md="6" class="mt-n6">
                                        <v-text-field
                                            v-model="product.contactPerson"
                                            outlined
                                            label="Contact Person"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" class="mt-n6">
                                        <vue-editor :editorToolbar="customToolbar.facility" placeholder="Fasilitas" v-model="product.facility"></vue-editor>
                                    </v-col>
                                    <v-col cols="12" >
                                        <vue-editor :editorToolbar="customToolbar.desc" placeholder="Deskripsi" v-model="product.desc"></vue-editor>
                                    </v-col>
                                </v-row>
                            </v-card-text>
                        </v-card>
                    </v-dialog>
                </v-row>
            </div>
        </v-content>
    </v-app>
</template>

<script>

import { VueEditor } from "vue2-editor";

export default {
    name: 'Dashboard',

    components: {
        VueEditor
    },

    data() {
        return {
            search:'',
            condition: [
                {
                    id:1,
                    name:'Baru'
                },
                {
                    id:2,
                    name:'Bekas'
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
                desc: [
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
            // Object For CRUD Goes Here
            product: {
                name:'',
                price:'',
                location:null,
                lb:'',
                lt:'',
                condition:'',
                facility:'',
                desc:'',
                contactPerson:'',
            },
            productDefault: {
                name:'',
                price:'',
                location:null,
                lb:'',
                lt:'',
                condition:'',
                facility:'',
                desc:'',
                contactPerson:'',
            },
            // Dialog State Goes Here
            createDialog:false
        }
    },

    methods: {
        close() {
            this.createDialog = false
        }
    },

    computed: {
        getProvince() {
            return this.$store.state.province.province
        },
    }
}
</script>

<style>
.v-dialog > .v-card > .v-toolbar {
  position: sticky;
  top: 0;
  z-index: 999;
}
</style>