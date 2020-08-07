<template>
    <v-app>
        <v-content class="ma-12">
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
                                        <template v-slot:label>Luas Min (m<sup>2</sup>)</template>
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
                                        <template v-slot:label>Luas Maks (m<sup>2</sup>)</template>
                                    </v-text-field>
                                </v-col>
                            </v-navigation-drawer>
                        </v-card>
                        <v-card height="400px" flat class="mt-10"></v-card>
                    </v-col>
                    <v-col cols="12" sm="12" md="9" class="pl-md-16">
                        <v-data-table
                            :headers="productHeader"
                            :items="products"
                            :disable-sort="true"
                            :hide-default-header="true"
                            :hide-default-footer="true"
                            :page.sync="pagination.page"
                            @page-count="pagination.pageCount = $event"
                        >
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
                itemsPerPage:15
            }
        }
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
                {value:'name', align:' d-none'},
                {value:'price', align:' d-none'},
                {value:'location', align:' d-none'},
                {value:'luasTanah', align:' d-none'},
                {value:'condition', align:' d-none'},
            ]
        }
    }
}
</script>

<style>
.toolbar {
  position: -webkit-sticky;
  position: sticky;
  top: 15%;
  z-index: 1;
  overflow-y:auto;
}

.toolbar::-webkit-scrollbar{
  display: none;
}
</style>