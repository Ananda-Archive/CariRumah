<template>
    <v-app>
        <v-content class="ma-md-12">
            <v-container fluid>
                <v-row justify-center>
                    <v-col cols="12" class="text-center">
                        <v-row no-gutter>
                            <v-col :cols="[product.images.length>1? '7' : '12']">
                                <v-card width="100%">
                                    <v-img :height="[$vuetify.breakpoint.xl? '500px' : '400px']" :src=product.images[0].image :lazy-src=product.images[0].image>
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
                                    <v-img :height="[$vuetify.breakpoint.xl? '240px' : '190px']" :src=product.images[n].image :lazy-src=product.images[n].image></v-img>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>

import api from '@/api'
import _ from 'lodash'

export default {
    data() {
        return {
            products:[],
            product:{},
            loadingState: false,
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