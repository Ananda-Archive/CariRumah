<template>
    <v-app>
        <v-content class="my-md-12 mx-md-16 px-md-16">
            <v-container fluid>
                <v-row justify-center>
                    <v-col cols="12" class="text-center">
                        <v-row no-gutter>
                            <v-col :cols="[product.images.length>1? '7' : '12']">
                                <v-card width="100%">
                                    <v-img :height="[$vuetify.breakpoint.xl? '500px' : '400px']" :src=product.images[0].image :lazy-src=product.images[0].image @click="index = 0">
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
                            <v-col cols="5" v-if="product.images.length > 1">
                                <v-card width="100%" v-for="(n,idx) in 2" :key="idx" class="marginCard">
                                    <v-img :height="[$vuetify.breakpoint.xl? '240px' : '190px']" :src=product.images[n].image :lazy-src=product.images[n].image @click="index = n" class="align-end">
                                        <v-container fluid full-height>
                                            <v-row>
                                                <v-col cols="12" class="text-right"><v-btn v-if="n == 2" depressed class="primary" dark @click.stop="index = 0">Lihat Semua Foto ({{productImages.length}})</v-btn></v-col>
                                            </v-row>
                                        </v-container>
                                    </v-img>
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
            loadingState: false,
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
            api.getAllProduct()
                .then((response) => {
                    this.products = response
                    this.product = _.find(this.products, ['id',this.$route.params.id])
                    this.product.images.forEach(e => {
                        this.productImages.push(e.image)
                    });
                    this.loadingState = false
                })
        },
        goTo(id) {
            this.id = id
            this.$router.push('/Products/'+id)
            this.get()
            window.scrollTo(0,0);
        }
    }
}
</script>

<style>
.marginCard:first-child {
    margin-bottom: 20px
}
</style>