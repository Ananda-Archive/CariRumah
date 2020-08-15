<template>
    <v-app>
        <v-content class=" mx-md-16 px-md-9">
            <v-overlay :value="loadingInitial"><v-progress-circular indeterminate size="64"></v-progress-circular></v-overlay>
            <v-container fluid class="px-xl-16">
                <v-row justify-center class="px-xl-16">
                    <v-col cols="12" class="text-center">
                        <v-row no-gutter>
                            <v-col cols="12" sm="12" :md="[product.images.length>1? '8' : '12']">
                                <v-card width="100%">
                                    <v-img style="cursor: pointer" :height="[$vuetify.breakpoint.xl? '500px' : '400px']" :src=product.images[0].image :lazy-src=product.images[0].image @click="index = 0">
                                        <template v-slot:placeholder>
                                            <v-row
                                                class="fill-height ma-0"
                                                align="center"
                                                justify="center"
                                            >
                                                <v-progress-circular indeterminate color="primary"></v-progress-circular>
                                            </v-row>
                                        </template>
                                    </v-img>
                                </v-card>
                            </v-col>
                            <v-col cols="4" v-if="product.images.length > 1 && !$vuetify.breakpoint.smAndDown">
                                <div v-if="product.images.length>2">
                                    <v-card width="100%" v-for="(n,idx) in 2" :key="idx" class="marginCard">
                                        <v-img style="cursor: pointer" :height="[$vuetify.breakpoint.xl? '240px' : '190px']" :src=product.images[n].image :lazy-src=product.images[n].image @click="index = n" class="align-end">
                                            <v-container fluid full-height>
                                                <v-row>
                                                    <v-col cols="12" class="text-right"><v-btn v-if="n == 2" depressed class="primary" dark @click.stop="index = 0">Lihat Semua Foto ({{productImages.length}})</v-btn></v-col>
                                                </v-row>
                                            </v-container>
                                            <template v-slot:placeholder>
                                                <v-row
                                                    class="fill-height ma-0"
                                                    align="center"
                                                    justify="center"
                                                >
                                                    <v-progress-circular indeterminate color="primary"></v-progress-circular>
                                                </v-row>
                                            </template>
                                        </v-img>
                                    </v-card>
                                </div>
                                <div v-else>
                                    <v-card width="100%" class="marginCard">
                                        <v-img style="cursor: pointer" :height="[$vuetify.breakpoint.xl? '240px' : '190px']" :src=product.images[1].image :lazy-src=product.images[1].image @click="index = 1" class="align-end">
                                            <template v-slot:placeholder>
                                                <v-row
                                                    class="fill-height ma-0"
                                                    align="center"
                                                    justify="center"
                                                >
                                                    <v-progress-circular indeterminate color="primary"></v-progress-circular>
                                                </v-row>
                                            </template>
                                        </v-img>
                                    </v-card>
                                </div>
                            </v-col>
                        </v-row>
                    </v-col>
                    <v-col cols="12" sm="12" md="8" class="mt-md-n2 mt-n8">
                        <v-row>
                            <!-- <v-col cols="12" class="mb-n2 mt-n3">
                                <v-chip label color="primary" v-if="product.productCondition == 1"><span class="text-h6 font-weight-regular">Baru</span></v-chip>
                                <v-chip label color="yellow darken-4" dark v-if="product.productCondition == 2"><span class="text-h6 font-weight-regular">Baru</span></v-chip>
                            </v-col> -->
                            <v-col cols="12" class="mb-n3 mb-md-n2">
                                <h1 class="primary--text">{{product.name}}</h1>
                                <v-chip small label color="orange" dark>{{convertProperty(product.property)}}</v-chip>
                            </v-col>
                            <v-col cols="12">
                                <div><h3>Spesifikasi</h3></div>
                                <div v-html="product.facility"></div>
                            </v-col>
                            <v-col cols="12">
                                <div><h3>Dokumen</h3></div>
                                <div v-html="product.document"></div>
                            </v-col>
                        </v-row>
                    </v-col>
                    <v-col cols="12" sm="12" md="4" class="pt-0 pt-md-4">
                        <v-card class="py-2 primary" dark elevation="7">
                            <v-col cols="12">
                                <div class="d-flex flex-no-wrap justify-space-between align-center">
                                    <div>
                                        <h3 class="font-weight-regular">Harga</h3>
                                    </div>
                                    <div><h3>Rp{{convertCurr(product.price)}}</h3></div>
                                </div>
                            </v-col>
                        </v-card>
                        <v-card elevation="7" class="mt-6">
                            <v-col cols="12">
                                <v-row>
                                    <v-col cols="12" sm="12" md="12">
                                        <v-row>
                                            <v-col cols="6">
                                                <div class="d-flex flex-no-wrap justify-start align-center">
                                                    <div class="mr-2">
                                                        <v-icon large color="primary">mdi-map-marker</v-icon>
                                                    </div>
                                                    <div>
                                                        <span><h4>Lokasi</h4>{{product.location}}</span>
                                                    </div>
                                                </div>
                                            </v-col>
                                            <v-col cols="6">
                                                <div class="d-flex flex-no-wrap justify-start align-center">
                                                    <div class="mr-2">
                                                        <v-icon large color="primary">mdi-home-account</v-icon>
                                                    </div>
                                                    <div>
                                                        <span>
                                                            <h4>Kondisi</h4>
                                                            <span v-if="product.productCondition == 1">Baru</span>
                                                            <span v-if="product.productCondition == 2">Bekas</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </v-col>
                                        </v-row>
                                    </v-col>
                                </v-row>
                            </v-col>
                            <v-col cols="12" class="mt-n12">
                                <v-row>
                                    <v-col cols="12" sm="12" md="12">
                                        <v-row>
                                            <v-col cols="6">
                                                <div class="d-flex flex-no-wrap justify-start align-center">
                                                    <div class="mr-2">
                                                        <v-icon large color="primary">mdi-arrow-expand</v-icon>
                                                    </div>
                                                    <div>
                                                        <span><h4>Luas Tanah</h4>{{product.lt}} m<sup>2</sup></span>
                                                    </div>
                                                </div>
                                            </v-col>
                                            <v-col cols="6">
                                                <div class="d-flex flex-no-wrap justify-start align-center">
                                                    <div class="mr-2">
                                                        <v-icon large color="primary">mdi-arrow-expand</v-icon>
                                                    </div>
                                                    <div>
                                                        <span><h4>Luas Bangunan</h4>{{product.lb}} m<sup>2</sup></span>
                                                    </div>
                                                </div>
                                            </v-col>
                                        </v-row>
                                    </v-col>
                                </v-row>
                            </v-col>
                        </v-card>
                        <v-card elevation="7" class="green mt-6" dark>
                            <v-col cols="12">
                                <div class="d-flex flex-no-wrap justify-space-between align-center">
                                    <div>
                                        <h3 class="font-weight-regular">Contact Person</h3>
                                    </div>
                                    <div><h3>{{product.contactPerson}}</h3></div>
                                </div>
                            </v-col>
                        </v-card>
                    </v-col>
                    <v-col cols="12" v-if="!$vuetify.breakpoint.smAndDown">
                        <v-row>
                            <v-col cols="12" class="mt-8"><v-divider></v-divider></v-col>
                            <v-col cols="12">
                                <h1>{{convertProperty(product.property)}} Lainnya di {{product.location}}</h1>
                            </v-col>
                            <v-col class="text-left" cols="12" sm="12" md="4" xl="3" v-for="(product,idx) in anotherProduct" :key="idx">
                                <v-card width="600px" @click="goTo(product.id)" style="cursor:pointer">
                                    <v-img height="200px" :lazy-src="product.images[0].image" :src="product.images[0].image">
                                        <v-col cols="12" class="text-right" v-if="product.productCondition == 1">
                                            <v-chip
                                                text-color="white"
                                                color="primary"
                                                small
                                            >
                                                Baru
                                            </v-chip>
                                        </v-col>
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
                                    <v-card-title v-if="$vuetify.breakpoint.lgAndDown">{{product.name.slice(0,15)}}</v-card-title>
                                    <v-card-title v-if="$vuetify.breakpoint.xl">{{product.name.slice(0,17)}}</v-card-title>
                                    <v-card-subtitle>{{product.location}}</v-card-subtitle>
                                    <!-- <v-card-subtitle class="pt-0">{{convertLocation(product.property)}}</v-card-subtitle> -->
                                    <v-card-text class="mt-n4 black--text">
                                        <div class="d-flex flex-no-wrap justify-space-between align-center">
                                            <div>
                                                <v-card-text class="pl-0 pb-0">Luas Bangunan</v-card-text>
                                            </div>
                                            <div>
                                                <v-card-text class="pr-0 pb-0">{{product.lb}}m<sup>2</sup></v-card-text>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-no-wrap justify-space-between align-center">
                                            <div>
                                                <v-card-text class="pl-0 pt-2">Luas Tanah</v-card-text>
                                            </div>
                                            <div>
                                                <v-card-text class="pr-0 pt-2">{{product.lt}}m<sup>2</sup></v-card-text>
                                            </div>
                                        </div>
                                        <div>
                                            <v-card-title class="pa-0 primary--text">Rp{{convertCurr(product.price)}}</v-card-title>
                                        </div>
                                    </v-card-text>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
            </v-container>
        </v-content>
        <Tinybox
            v-model="index"
            :images="productImages"
            loop
        />
    </v-app>
</template>

<script>

import api from '@/api'
import _ from 'lodash'
import Tinybox from "vue-tinybox"


export default {
    components: { Tinybox },
    data() {
        return {
            index:null,
            products:[],
            product:{},
            productImages:[],
            anotherProduct:[],
            productProperty: [
                {
                    id:"1",
                    name:'Perumahan'
                },
                {
                    id:"2",
                    name:'Rumah Dijual'
                },
                {
                    id:"3",
                    name:'Tanah Dijual'
                },
                {
                    id:"4",
                    name:'Rumah Disewakan'
                },
                {
                    id:"5",
                    name:'Tanah Disewakan'
                },
                {
                    id:"6",
                    name:'Jual Kos'
                },
                {
                    id:"7",
                    name:'Sewa Kos'
                }
            ],
            loadingState: false,
            loadingInitial: true,
            overlay: true,
        }
    },

    created() {
        this.get()
    },

    watch: {
        '$route': 'get'
    },

    methods: {
        get() {
            this.loadingState = true
            this.loadingInitial = true
            api.getAllProduct()
                .then((response) => {
                    this.products = response
                    this.product = _.find(this.products, ['id',this.$route.params.id])
                    this.productImages = []
                    this.product.images.forEach(e => {
                        this.productImages.push(e.image)
                    });
                    this.anotherProduct = []
                    this.products.forEach(e => {
                        if(e.location == this.product.location) {
                            if(e.property == this.product.property) {
                                if(e.id != this.product.id) {
                                    this.anotherProduct.push(e)
                                }
                            }
                        }
                    });
                    this.loadingState = false
                }) .finally(() => {
                    this.loadingInitial = false
                })
        },
        goTo(id) {
            this.id = id
            this.$router.push('/Products/'+id)
            this.get()
            window.scrollTo(0,0);
        },
        convertCurr(val) {
            let temp = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'IDR' }).format(val)
            return temp.slice(0, -7)
        },
        convertProperty(id) {
            return _.find(this.productProperty, function(o) { return o.id == id}).name
        },
    }
}
</script>

<style>
.marginCard:first-child {
    margin-bottom: 20px
}
</style>