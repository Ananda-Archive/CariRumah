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
     <v-main class="py-0">
         <v-carousel height="800" cycle>
            <v-carousel-item
                v-for="(data,idx) in datas"
                :key="idx"
                :src="data.img[0]"
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
        <v-dialog v-if="!breakPoint" v-model="detailPromo" :max-width="[$vuetify.breakpoint.xl? '1600px' : '1200px']">
            <v-card >
                <v-toolbar dense flat color="primary" dark>
                    <span class="title font-weight-light">Detail Promo</span>
                    <v-btn absolute right icon @click="close"><v-icon>mdi-close</v-icon></v-btn>
                </v-toolbar>
                <v-card-text>
                    <v-row justify-center>
                        <v-col cols="5" class="text-center">
                            <v-card>
                                <v-img :lazy-src="data.img[0]" :src="data.img[0]">
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
                        <v-col cols="7">
                            <v-card-title class="primary--text pt-0"><h1>{{data.name}}</h1></v-card-title>
                            <v-card-text v-html="data.desc"></v-card-text>
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>
        </v-dialog>
     </v-main>
</template>

<script>

import _ from 'lodash'

export default {
    name: 'HomeTwo',

    data() {
        return {
            datas:[
                {
                    id:1,
                    name:'Promo XXX',
                    desc:'<p><b>Lorem</b> ipsum dolor sit amet, consectetur adipiscing elit. Fusce finibus dui eget erat lacinia iaculis. Nullam vitae lectus tellus. Nulla ut odio quis sapien pharetra interdum at et quam. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam tempus elit sit amet orci congue tristique. Fusce feugiat ultricies ipsum nec laoreet. Cras feugiat ipsum nec nisi consectetur, in imperdiet justo malesuada. Phasellus porta scelerisque massa. Aliquam efficitur urna ut risus malesuada, sit amet rhoncus ipsum sodales. Suspendisse vitae tortor at diam laoreet scelerisque. In ac erat vel lectus volutpat pretium. Cras vehicula, ipsum et tincidunt consectetur, neque orci consectetur ex, eget elementum orci sapien at nunc. Mauris mattis, justo non sollicitudin finibus, erat neque scelerisque lacus, sit amet accumsan lectus dolor sit amet elit. Aenean non eros vitae magna finibus interdum. Nunc libero orci, sodales sed imperdiet et, rhoncus id diam. Etiam porta facilisis ante et fringilla.</p>',
                    img: [
                        'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/ezgif-2-62107962e111.jpg?alt=media&token=57b480fc-a0ed-466a-be71-c0988c1a8f0f'
                    ]
                },
                {
                    id:2,
                    name:'Promo YYY',
                    desc:'Nam et hendrerit ante. Sed sed neque orci. Mauris iaculis condimentum felis, ac fringilla turpis. Praesent ut egestas ex. Suspendisse eget odio at lectus sollicitudin bibendum eu congue dui. Vivamus sit amet lorem at orci tempus porta ut et sem. Phasellus non lectus faucibus risus vehicula bibendum. Donec ac tincidunt dui. Sed ac sodales ligula. Suspendisse efficitur odio urna, eget malesuada lorem ultricies et. In commodo, magna posuere tincidunt varius, quam tellus iaculis orci, id commodo lacus tellus in ipsum. Aenean vestibulum felis sapien, consequat viverra leo dapibus a. Aenean laoreet maximus eros nec ullamcorper. Nunc gravida turpis ac justo efficitur cursus. Praesent et massa enim.',
                    img: [
                        'https://firebasestorage.googleapis.com/v0/b/carirumah-45009.appspot.com/o/175327.jpg?alt=media&token=292446cf-00ec-4b76-b4e3-4e4e676f2b6b'
                    ]
                },
            ],
            data: {
                id:null,
                name:'',
                desc:'',
                img:[]
            },
            dataDefault: {
                id:null,
                name:'',
                desc:'',
                img:[]
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
        }
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