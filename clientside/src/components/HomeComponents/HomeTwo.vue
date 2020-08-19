<template>
     <!-- <v-parallax
        id="promo"
        :height="breakPoint ? 600 : 500"
        src="@/assets/promo.jpg"
     >
        <v-container fill-height>
            <v-overlay opacity="0.8" :absolute="true"></v-overlay>
            <v-row class="mx-auto" style="z-index:10000">
                <v-col cols="12" class="text-center changeFont">
                    <h2>KATALOG PROMO</h2>
                </v-col>
                <v-col cols="12">
                    <div class="text-center">
                        <v-btn large outlined dark>
                            <span>SELENGKAPNYA<v-icon class="ml-1">mdi-open-in-new</v-icon></span>
                        </v-btn>
                    </div>
                </v-col>
            </v-row>
        </v-container>
     </v-parallax> -->
     <v-main class="py-0" v-if="datas.length > 0">
         <v-carousel height="800" cycle>
            <v-carousel-item
                v-for="(data,idx) in datas"
                :key="idx"
                :src="data.image"
                reverse-transition="fade-transition"
                transition="fade-transition"
                @click="detail(data)"
                style="cursor:pointer"
            >
                <!-- <v-container fluid fill-height class="align-center pb-0">
                    <v-row>
                        <v-col cols="12" class="text-center">
                            <v-btn large outlined>
                                <span>SELENGKAPNYA<v-icon class="ml-1">mdi-open-in-new</v-icon></span>
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-container> -->
            </v-carousel-item>
        </v-carousel>
        <v-dialog v-model="detailPromo" :max-width="[$vuetify.breakpoint.xl? '1600px' : '1200px']">
            <v-card >
                <v-toolbar dense flat color="primary" dark>
                    <span class="title font-weight-light">Detail Promo</span>
                    <v-btn absolute right icon @click="close"><v-icon>mdi-close</v-icon></v-btn>
                </v-toolbar>
                <v-card-text>
                    <v-row justify-center>
                        <v-col cols="12" sm="12" md="5" class="text-center">
                            <v-card>
                                <v-img :lazy-src="data.image" :src="data.image">
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
                        <v-col cols="12" sm="12" md="7">
                            <v-card-title class="primary--text pt-0"><h1>{{data.title}}</h1></v-card-title>
                            <v-card-text v-html="data.content"></v-card-text>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-dialog>
     </v-main>
</template>

<script>

import _ from 'lodash'
import api from '@/api'

export default {
    name: 'HomeTwo',

    mounted() {
        this.get()
    },

    data() {
        return {
            datas:[],
            data: {
                id:null,
                title:'',
                content:'',
                image:''
            },
            dataDefault: {
                iid:null,
                title:'',
                content:'',
                image:''
            },
            detailPromo:false,
        }
    },

    methods: {
        detail(data) {
            this.data = _.cloneDeep(data)
            this.detailPromo = true
        },
        close() {
            this.data = _.cloneDeep(this.dataDefault)
            this.detailPromo = false
        },
        get() {
            api.getAllPromo()
                .then((response) => {
                    this.datas = response
                })
        },
    },

    computed: {
        breakPoint() {
            if (this.$vuetify.breakpoint.name == 'xs') {
                return true
            } else {
                return false
            }
        }
    }
}
</script>

<style>
.v-dialog > .v-card > .v-toolbar {
  position: sticky;
  top: 0;
  z-index: 999;
}
.scrollbarHide {
    overflow-y: scroll;
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none;  /* Internet Explorer 10+ */
}
.scrollbarHide::-webkit-scrollbar { 
    width: 0;
    height: 0;
}
</style>