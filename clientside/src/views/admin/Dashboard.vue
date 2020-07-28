<template>
    <v-app>
        <v-content app class="mx-4 my-7 mx-md-10 my-md-n5">
            <div>
                <v-row justify="center">
                    <!-- Search Feature -->
                    <v-col cols="12">
                        <v-text-field
                            outlined
                            dense
                            v-model="search"
                            label="Cari Data"
                            prepend-inner-icon="mdi-magnify"
                            :clearable="true"
                            @click:clear="search = ''"
                        ></v-text-field>
                    </v-col>
                    <!-- List -->
                    <!-- Add -->
                    <v-btn fab dark large color="primary" fixed right bottom @click="createDialog = !createDialog">
                        <v-icon dark>mdi-plus</v-icon>
                    </v-btn>
                    <v-dialog v-model="createDialog" max-width="1100px" persistent>
                        <v-card>
                            <v-toolbar dense flat>
                                <span class="title font-weight-light">Tambah Produk</span>
                                <v-btn absolute right icon @click="close"><v-icon>mdi-close</v-icon></v-btn>
                            </v-toolbar>
                            <v-card-text>
                                <v-row>
                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="product.name"
                                            label="Nama Produk"
                                            outlined
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="12" md="6" class="mt-n6">
                                        <v-text-field
                                            v-model="product.price"
                                            label="Harga"
                                            outlined
                                        ></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="12" md="6" class="mt-n6">
                                        <v-select
                                            v-model="product.condition"
                                            label="Kondisi"
                                            outlined
                                            :items="condition"
                                            item-text="name"
                                            item-value="id"
                                            :clearable="true"
                                            @click:clear='product.condition = null'
                                        >
                                        </v-select>
                                    </v-col>
                                    <v-col cols="12" sm="12" md="6" class="mt-n6">
                                        <v-text-field
                                            v-model="product.lt"
                                            outlined
                                        >
                                            <template v-slot:label>Luas Tanah (m<sup>2</sup>)</template>
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="12" md="6" class="mt-n6">
                                        <v-text-field
                                            v-model="product.lb"
                                            outlined
                                        >
                                            <template v-slot:label>Luas Bangunan (m<sup>2</sup>)</template>
                                        </v-text-field>
                                    </v-col>
                                </v-row>
                            </v-card-text>
                        </v-card>
                    </v-dialog>
                </v-row>
            </div>
        </v-content>
    </v-app>
</template>

<script>
export default {
    name: 'Dashboard',

    data() {
        return {
            search:'',
            condition: [
                {
                    id:1,
                    name:'Baru'
                },
                {
                    id:2,
                    name:'Bekas'
                }
            ],
            // Object For CRUD Goes Here
            product: {
                name:'',
                price:'',
                location:'',
                lb:'',
                lt:'',
                condition:'',
                facility:'',
                desc:'',
                contactPerson:'',
            },
            productDefault: {
                name:'',
                price:'',
                location:'',
                lb:'',
                lt:'',
                condition:'',
                facility:'',
                desc:'',
                contactPerson:'',
            },
            // Dialog State Goes Here
            createDialog:false
        }
    },

    methods: {
        close() {
            this.createDialog = false
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
</style>