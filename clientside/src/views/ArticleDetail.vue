<template>
    <v-app>
        <v-main class="ma-md-10">
            <v-container fluid>
                <v-row justify="center">
                    <v-card width="30%" v-if="article.image">
                        <v-img @click="index=0" :height="[$vuetify.breakpoint.xl? '400px' : '300px']" :src="article.image"></v-img>
                    </v-card>
                    <v-col cols="12" class="text-center">
                        <h1>{{article.title}}</h1>
                    </v-col>
                    <v-col cols="12">
                        <div v-html="article.content"></div>
                    </v-col>
                    <v-col cols="12" v-if="!$vuetify.breakpoint.smAndDown">
                        <v-row>
                            <v-col cols="12" class="mt-8"><v-divider></v-divider></v-col>
                            <v-col cols="12">
                                <h1>Artikel Lainnya</h1>
                            </v-col>
                            <v-col cols="12">
                                <v-row justify-center>
                                    <v-col cols="11" class="text-center">
                                        <v-row no-gutters>
                                            <v-col cols="12" sm="12" md="3" v-for="(article,idx) in filteredItems" :key="idx" :class="breakPoint ? 'gridArticle pb-6' : 'gridArticle pr-6 pb-6'">
                                                <v-card width="400px" align="left" @click="goTo(article.id)">
                                                    <v-img
                                                        aspect-ratio="1"
                                                        height="200px" 
                                                        :lazy-src="article.image" 
                                                        :src="article.image"
                                                        gradient="to bottom, rgba(0,0,0,.4), rgba(0,0,0,.8)"
                                                        class="white--text align-end"
                                                    >
                                                        <template v-slot:placeholder>
                                                            <v-row
                                                                class="fill-height ma-0"
                                                                align="center"
                                                                justify="center"
                                                            >
                                                                <v-progress-circular indeterminate color="black"></v-progress-circular>
                                                            </v-row>
                                                        </template>
                                                        <v-card-title>{{article.title.slice(0,40)}}</v-card-title>
                                                    </v-img>
                                                </v-card>
                                            </v-col>
                                        </v-row>
                                    </v-col>
                                </v-row>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
        <Tinybox
            v-model="index"
            :images="images"
            loop
            :no-thumbs="true"
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
            articles:[],
            anotherArticles:[],
            article:{
                id:null,
                title:'',
                content:'',
                image:''
            },
            images:[]
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
            api.getAllArticle()
                .then((response) => {
                    this.articles = response
                    this.article = _.find(this.articles, ['id',this.$route.params.id])
                    this.images = []
                    this.anotherArticles = []
                    this.images.push(this.article.image)
                    this.articles.forEach(e => {
                        if(e.id != this.article.id) {
                            this.anotherArticles.push(e)
                        }
                    });
                })
        },
        goTo(id) {
            this.$router.push('/Article/'+id)
            window.scrollTo(0,0)
        },
    },

    computed: {
        filteredItems: function () {
            return this.anotherArticles.slice(0, 4)
        },
    }

}
</script>

<style>

</style>