<template>
    <v-app>
        <v-content class="ma-md-12">
            <v-container>
                <v-row>
                    <v-col cols="3" v-if="!breakPoint">
                        <v-card elevation="2" width="100%" class="pt-4 toolbar pb-n4">
                            <h3 class="text-center primary--text">Cari Sesuai Kebutuhanmu!</h3>
                            <v-navigation-drawer width="100%" floating permanent>
                                <v-col cols="12">
                                    <v-select
                                        outlined
                                        dense
                                        v-model="filter.property"
                                        :items="filterItem.property"
                                        item-text="name"
                                        item-value="id"
                                        :clearable="true"
                                        @click:clear="filter.property = null"
                                    >
                                        <template v-slot:prepend-inner><v-icon class="mr-2 primary--text">mdi-home-city</v-icon></template>
                                        <template v-slot:label>Jenis Properti</template>
                                    </v-select>
                                </v-col>
                                <v-col cols="12" class="mt-n6">
                                    <v-autocomplete
                                        outlined
                                        dense
                                        v-model="filter.location"
                                        :items="getProvince"
                                        item-text="nama"
                                        item-value="nama"
                                        :search-input.sync="filterSync.location"
                                        :clearable="true"
                                        :auto-select-first="true"
                                        :readonly="filter.location != null"
                                        @click:clear='filter.location = null'
                                    >
                                        <template v-slot:prepend-inner><v-icon class="mr-2 primary--text">mdi-home-map-marker</v-icon></template>
                                        <template v-slot:label>Lokasi</template>
                                    </v-autocomplete>
                                </v-col>
                                <v-col cols="12" class="mt-n6">
                                    <v-select
                                        outlined
                                        dense
                                        v-model="filter.condition"
                                        :items="filterItem.condition"
                                        item-text="name"
                                        item-value="id"
                                        :clearable="true"
                                        @click:clear='filter.condition = null'
                                    >
                                        <template v-slot:prepend-inner><v-icon class="mr-2 primary--text">mdi-home-account</v-icon></template>
                                        <template v-slot:label>Kondisi</template>
                                    </v-select>
                                </v-col>
                                <v-col cols="12" class="mt-n6">
                                    <v-text-field
                                        outlined
                                        dense
                                        v-model="filter.bottomPrice"
                                        :clearable="true"
                                        @click:clear="filter.bottomPrice = null"
                                    >
                                        <template v-slot:prepend-inner><span class="mr-2 mt-1 primary--text font-weight-bold">Rp</span></template>
                                        <template v-slot:label>Harga Min</template>
                                    </v-text-field>
                                </v-col>
                                <v-col cols="12" class="mt-n6">
                                    <v-text-field
                                        outlined
                                        dense
                                        v-model="filter.topPrice"
                                        :clearable="true"
                                        @click:clear="filter.topPrice = null"
                                    >
                                        <template v-slot:prepend-inner><span class="mr-2 mt-1 primary--text font-weight-bold">Rp</span></template>
                                        <template v-slot:label>Harga Maks</template>
                                    </v-text-field>
                                </v-col>
                                <v-col cols="12" class="mt-n6">
                                    <v-text-field
                                        outlined
                                        dense
                                        v-model="filter.bottomArea"
                                        :clearable="true"
                                        @click:clear="filter.bottomArea = null"
                                    >
                                        <template v-slot:prepend-inner><v-icon class="mr-2 primary--text">mdi-border-none</v-icon></template>
                                        <template v-slot:label>Luas Tanah Min (m<sup>2</sup>)</template>
                                    </v-text-field>
                                </v-col>
                                <v-col cols="12" class="mt-n6 pb-0">
                                    <v-text-field
                                        outlined
                                        dense
                                        v-model="filter.topArea"
                                        :clearable="true"
                                        @click:clear="filter.topArea = null"
                                    >
                                        <template v-slot:prepend-inner><v-icon class="mr-2 primary--text">mdi-border-outside</v-icon></template>
                                        <template v-slot:label>Luas Tanah Maks (m<sup>2</sup>)</template>
                                    </v-text-field>
                                </v-col>
                            </v-navigation-drawer>
                        </v-card>
                        <v-card height="400px" flat class="mt-10"></v-card>
                    </v-col>
                    <v-btn v-else fab dark large color="primary" fixed right bottom class="mr-3 mb-2" @click="filterMenu = !filterMenu">
                        <v-icon>mdi-filter-menu</v-icon>
                    </v-btn>
                    <v-dialog max-width="1000px" v-model="filterMenu">
                        <v-card>
                            <v-toolbar dense flat dark color="primary">
                                <span class="title font-weight-light">Cari Sesuai Kebutuhanmu</span>
                                <v-btn absolute right icon @click="filterMenu = !filterMenu"><v-icon>mdi-close</v-icon></v-btn>
                            </v-toolbar>
                            <v-card-text>
                                <v-col cols="12">
                                    <v-select
                                        outlined
                                        dense
                                        v-model="filter.property"
                                        :items="filterItem.property"
                                        item-text="name"
                                        item-value="id"
                                        :clearable="true"
                                        @click:clear="filter.property = null"
                                    >
                                        <template v-slot:prepend-inner><v-icon class="mr-2 primary--text">mdi-home-city</v-icon></template>
                                        <template v-slot:label>Jenis Properti</template>
                                    </v-select>
                                </v-col>
                                <v-col cols="12" class="mt-n6">
                                    <v-autocomplete
                                        outlined
                                        dense
                                        v-model="filter.location"
                                        :items="getProvince"
                                        item-text="nama"
                                        item-value="nama"
                                        :search-input.sync="filterSync.location"
                                        :clearable="true"
                                        :auto-select-first="true"
                                        :readonly="filter.location != null"
                                        @click:clear='filter.location = null'
                                    >
                                        <template v-slot:prepend-inner><v-icon class="mr-2 primary--text">mdi-home-map-marker</v-icon></template>
                                        <template v-slot:label>Lokasi</template>
                                    </v-autocomplete>
                                </v-col>
                                <v-col cols="12" class="mt-n6">
                                    <v-select
                                        outlined
                                        dense
                                        v-model="filter.condition"
                                        :items="filterItem.condition"
                                        item-text="name"
                                        item-value="id"
                                        :clearable="true"
                                        @click:clear='filter.condition = null'
                                    >
                                        <template v-slot:prepend-inner><v-icon class="mr-2 primary--text">mdi-home-account</v-icon></template>
                                        <template v-slot:label>Kondisi</template>
                                    </v-select>
                                </v-col>
                                <v-col cols="12" class="mt-n6">
                                    <v-text-field
                                        outlined
                                        dense
                                        v-model="filter.bottomPrice"
                                        :clearable="true"
                                        @click:clear="filter.bottomPrice = null"
                                    >
                                        <template v-slot:prepend-inner><span class="mr-2 mt-1 primary--text font-weight-bold">Rp</span></template>
                                        <template v-slot:label>Harga Min</template>
                                    </v-text-field>
                                </v-col>
                                <v-col cols="12" class="mt-n6">
                                    <v-text-field
                                        outlined
                                        dense
                                        v-model="filter.topPrice"
                                        :clearable="true"
                                        @click:clear="filter.topPrice = null"
                                    >
                                        <template v-slot:prepend-inner><span class="mr-2 mt-1 primary--text font-weight-bold">Rp</span></template>
                                        <template v-slot:label>Harga Maks</template>
                                    </v-text-field>
                                </v-col>
                                <v-col cols="12" class="mt-n6">
                                    <v-text-field
                                        outlined
                                        dense
                                        v-model="filter.bottomArea"
                                        :clearable="true"
                                        @click:clear="filter.bottomArea = null"
                                    >
                                        <template v-slot:prepend-inner><v-icon class="mr-2 primary--text">mdi-border-none</v-icon></template>
                                        <template v-slot:label>Luas Tanah Min (m<sup>2</sup>)</template>
                                    </v-text-field>
                                </v-col>
                                <v-col cols="12" class="mt-n6 pb-0">
                                    <v-text-field
                                        outlined
                                        dense
                                        v-model="filter.topArea"
                                        :clearable="true"
                                        @click:clear="filter.topArea = null"
                                    >
                                        <template v-slot:prepend-inner><v-icon class="mr-2 primary--text">mdi-border-outside</v-icon></template>
                                        <template v-slot:label>Luas Tanah Maks (m<sup>2</sup>)</template>
                                    </v-text-field>
                                </v-col>
                            </v-card-text>
                            <v-card-actions>
                                <v-container>
                                    <v-row justify="center">
                                        <v-btn large class="mt-n8" color="blue darken-1 white--text" @click="filterMenu = !filterMenu">
                                            <span>Close</span>
                                        </v-btn>
                                    </v-row>
                                </v-container>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <v-col cols="12" sm="12" md="9" class="pl-md-16">
                        <v-data-table
                            :headers="productHeader"
                            :items="products"
                            :disable-sort="true"
                            :hide-default-header="true"
                            :hide-default-footer="true"
                            :page.sync="pagination.page"
                            :loading="loadingState"
                            items-per-page="12"
                            @page-count="pagination.pageCount = $event"
                        >
                            <template v-slot:body="{items}">
                                <v-container fluid class="pt-0" v-if="!loadingState && items.length">
                                    <v-row>
                                        <v-col class="text-left" cols="12" sm="12" md="4" xl="3" v-for="(product,idx) in items" :key="idx">
                                            <v-card :class="[$vuetify.breakpoint.smAndDown? 'mx-auto': '']" :width="[$vuetify.breakpoint.smAndDown? '90vw' : '600px']" @click="goTo(product.id)" style="cursor:pointer">
                                                <v-img aspect-ratio="1"  height="200px" :lazy-src="product.images[0].image" :src="product.images[0].image">
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
                                                            <v-card-text class="pl-0 pb-0">Jenis Properti</v-card-text>
                                                        </div>
                                                        <div>
                                                            <v-card-text class="pr-0 pb-0">{{convertLocation(product.property)}}</v-card-text>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-no-wrap justify-space-between align-center">
                                                        <div>
                                                            <v-card-text class="pl-0 pb-0 pt-2">Luas Tanah</v-card-text>
                                                        </div>
                                                        <div>
                                                            <v-card-text class="pr-0 pb-0 pt-2">{{product.lt}}m<sup>2</sup></v-card-text>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-no-wrap justify-space-between align-center">
                                                        <div>
                                                            <v-card-text class="pl-0 pt-2">Luas Bangunan</v-card-text>
                                                        </div>
                                                        <div>
                                                            <v-card-text class="pr-0 pt-2">{{product.lb}}m<sup>2</sup></v-card-text>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <v-card-title class="pa-0 primary--text">Rp{{convertCurr(product.price)}}</v-card-title>
                                                    </div>
                                                </v-card-text>
                                            </v-card>
                                        </v-col>
                                    </v-row>
                                </v-container>
                                <v-container fluid class="pt-0" v-else-if="!loadingState && !items.length">
                                    <v-row justify-center>
                                        <v-col cols="12" class="text-center">
                                            <v-icon style="font-size:100px">mdi-home-search-outline</v-icon>
                                        </v-col>
                                        <v-col cols="12" class="text-center">
                                            <h3 class="mt-3">Produk yang Anda Cari Tidak Ditemukan</h3>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </template>
                            <template v-slot:no-data>
                                <div class="mb-6 mt-md-10">
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
                            <template v-slot:progress>
                                <v-container fluid>
                                    <v-row justify-center>
                                        <v-col cols="12" class="text-center">
                                            <v-icon x-large style="font-size:10em" class="primary--text">mdi-loading mdi-spin</v-icon>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </template>
                        </v-data-table>
                        <div class="text-center">
                            <v-pagination v-model="pagination.page" :length="pagination.pageCount" :total-visible="7"></v-pagination>
                        </div>
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
    name:'Products',

    data() {
        return {
            filter: {
                property:null,
                location:null,
                condition:null,
                bottomPrice:null,
                topPrice:null,
                bottomArea:null,
                topArea:null,
            },
            filterSync: {
                property:'',
                location:'',
                condition:''
            },
            filterItem: {
                property: [
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
                condition: [
                    {
                        id:1,
                        name:'Baru'
                    },
                    {
                        id:2,
                        name:'Bekas'
                    }
                ]
            },
            products:[],
            pagination: {
                page:1,
                pageCount:0,
                itemsPerPage:12
            },
            loadingState:true,
            filterMenu: false,
        }
    },

    mounted() {
        this.get()
    },

    methods: {
        goTo(id) {
            this.$router.push('/Products/'+id)
        },
        get() {
            this.loadingState = true
            api.getAllProduct()
                .then((response) => {
                    this.products = response
                    this.loadingState = false
                })
        },
        convertLocation(id) {
            return _.find(this.filterItem.property, function(o) { return o.id == id}).name
        },
        convertCurr(val) {
            let temp = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'IDR' }).format(val)
            return temp.slice(0, -7)
        },
        advanceSearchlt(val) {
            if(!this.filter.bottomArea && !this.filter.topArea) {
                return true
            }
            if(this.filter.bottomArea && !this.filter.topArea) {
                return +val >= +this.filter.bottomArea
            } else {
                if(!this.filter.bottomArea && this.filter.topArea) {
                    return +val <= +this.filter.topArea
                } else {
                    if(this.filter.bottomArea && this.filter.topArea) {
                        return (+val >= +this.filter.bottomArea && +val <= +this.filter.topArea)
                    }
                }
            }
        },
        advanceSearchProperty(val) {
            if(!this.filter.property) {
                return true
            } return val == this.filter.property
        },
        advanceSearchLocation(val) {
            if(!this.filter.location) {
                return true
            } return val === this.filter.location
        },
        advanceSearchProductCondition(val) {
            if(!this.filter.condition) {
                return true
            } return val == this.filter.condition
        },
        advanceSearchPrice(val) {
            if(!this.filter.bottomPrice && !this.filter.topPrice) {
                return true
            }
            if(this.filter.bottomPrice && !this.filter.topPrice) {
                return +val >= +this.filter.bottomPrice
            } else {
                if(!this.filter.bottomPrice && this.filter.topPrice) {
                    return +val <= +this.filter.topPrice
                } else {
                    if(this.filter.bottomPrice && this.filter.topPrice) {
                        return (+val >= +this.filter.bottomPrice && +val <= +this.filter.topPrice)
                    }
                }
            }
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
        getProvince() {
            return this.$store.state.province.province
        },
        productHeader() {
            return [
                {value:'name', align:' d-none',filter:this.advanceSearchName},
                {value:'price', align:' d-none', filter:this.advanceSearchPrice},
                {value:'location', align:' d-none', filter:this.advanceSearchLocation},
                {value:'lt', align:' d-none', filter:this.advanceSearchlt},
                {value:'productCondition', align:' d-none', filter:this.advanceSearchProductCondition},
                {value:'property', align:' d-none', filter:this.advanceSearchProperty},
            ]
        }
    }
}
</script>

<style>
.toolbar {
  position: -webkit-sticky!important;
  position: sticky!important;
  top: 15%!important;
  z-index: 1!important;
  overflow-y:auto!important;
}

.toolbar::-webkit-scrollbar{
  display: none!important;
}

.v-dialog > .v-card > .v-toolbar {
  position: sticky;
  top: 0;
  z-index: 999;
}
</style>