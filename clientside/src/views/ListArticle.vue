<template>
    <v-app>
        <v-main class="my-12">
            <v-data-table
                :headers="articleHeader"
                :items="articles"
                :disable-sort="true"
                :hide-default-header="true"
                :hide-default-footer="true"
                :page.sync="pagination.page"
                items-per-page="12"
                @page-count="pagination.pageCount = $event"
            >
                <template v-slot:body="{items}">
                    <v-container fluid v-if="items.length > 0">
                        <v-row justify="center">
                            <v-col cols="11" class="text-center">
                                <v-row no-gutters>
                                    <v-col cols="12" sm="12" md="3" v-for="(article,idx) in items" :key="idx" :class="breakPoint ? 'gridArticle pb-6' : 'gridArticle pr-6 pb-6'">
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
                    </v-container>
                    <v-container v-else>
                        <v-row justify-center>
                            <v-col cols="12" class="text-center">
                                <v-icon style="font-size:100px">mdi-file-remove</v-icon>
                            </v-col>
                            <v-col cols="12" class="text-center">
                                <h3 class="">Belum Ada Artikel</h3>
                            </v-col>
                        </v-row>
                    </v-container>
                </template>
                <template v-slot:no-data>
                    <div class="mb-6 mt-md-10">
                        <v-icon style="font-size:100px">mdi-file-remove</v-icon>
                        <h3 class="mt-3">Belum Ada Artikel</h3>
                    </div>
                </template>
            </v-data-table>
            <div class="text-center">
                <v-pagination v-model="pagination.page" :length="pagination.pageCount" :total-visible="7"></v-pagination>
            </div>
        </v-main>
    </v-app>
</template>

<script>

import api from '@/api'

export default {
    data() {
        return {
            articles: [],
            pagination: {
                page:1,
                pageCount:0,
                itemsPerPage:12
            },
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
        goTo(id) {
            this.$router.push('/Article/'+id)
            window.scrollTo(0,0)
        },
    },

    computed: {
        breakPoint() {
            if (this.$vuetify.breakpoint.name == 'xs') {
                return true
            } else {
                return false
            }
        },
        articleHeader() {
            return [
                {value:'title', align:' d-none'},
            ]
        }
    }
}
</script>

<style>

</style>