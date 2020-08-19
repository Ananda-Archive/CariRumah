<template>
    <section id="article">
        <div class="py-12">
            <v-container fluid class="text-center">
                <h2 :class="[$vuetify.breakpoint.smAndDown ? 'display-1' : 'display-2']" class="font-weight-bold mb-3">KONTEN PENCERDASAN</h2>
                <v-responsive class="mx-auto mb-8" width="56">
                    <v-divider class="mb-1"></v-divider>
                    <v-divider></v-divider>
                </v-responsive>
                <!-- Grid for article -->
                <v-contain fluid>
                    <v-row justify="center">
                        <v-col cols="11" class="text-center">
                            <v-row no-gutters>
                                <v-col cols="12" sm="12" md="3" v-for="(article,idx) in filteredItems" :key="idx" :class="breakPoint ? 'gridArticle pb-6' : 'gridArticle pr-6 pb-6'">
                                    <v-card width="400px" align="left" @click="goToArticle(article.id)">
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
                        <v-col cols="12" class="text-center">
                            <v-btn @click="goTo()" class="primary--text" outlined large>lihat artikel lain</v-btn>
                        </v-col>
                    </v-row>
                </v-contain>
            </v-container>
        </div>
    </section>
</template>

<script>

import api from '@/api'

export default {
    name: 'HomeThree',

    data() {
        return {
            articles: []
        }
    },

    mounted() {
        this.get()
    },

    methods: {
        get() {
            api.getAllArticle()
                .then((response) => {
                    this.articles = response
                })
        },
        goTo() {
            this.$router.push('/ListArticle')
        },
        goToArticle(id) {
            this.$router.push('/Article/'+id)
            window.scrollTo(0,0)
        },
    },

    computed: {
        filteredItems: function () {
            return this.articles.slice(0, 4)
        },
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
</style>