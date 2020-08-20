<template>
    <v-app>
        <v-content class="ma-12">
            <v-container fluid>
                <v-form ref="form">
                    <v-row>
                        <v-col cols="12">
                            <h1 class="font-weight-medium">DAFTAR MITRA</h1>
                            <v-divider></v-divider>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                v-model="data.name"
                                label="Nama"
                                outlined
                                :rules="rules.name"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="6" class="mt-n6">
                            <v-text-field
                                v-model="data.phoneNumber"
                                label="Nomor yang bisa dihubungi"
                                outlined
                                :rules="rules.phoneNumber"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="6" class="mt-n6">
                            <v-text-field
                                v-model="data.email"
                                label="Email"
                                outlined
                                :rules="rules.email"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" class="mt-n6">
                            <v-textarea
                                v-model="data.ownerAddress"
                                label="Alamat Pendaftar"
                                outlined
                                :rules="rules.ownerAddress"
                            ></v-textarea>
                        </v-col>
                        <v-col cols="12" class="mt-n6">
                            <v-textarea
                                v-model="data.address"
                                label="Alamat Rumah yang Ingin Dijual/Disewa"
                                outlined
                                :rules="rules.address"
                            ></v-textarea>
                        </v-col>
                        <v-col cols="12" sm="12" md="4" class="mt-n6">
                            <v-text-field
                                v-model="data.area"
                                outlined
                                :rules="rules.area"
                            ><template v-slot:label>Luas Bangunan (m<sup>2</sup>)</template></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="12" md="4" class="mt-n6">
                            <v-select
                                outlined
                                v-model="data.property"
                                label="Jenis Properti"
                                :items="property"
                                item-text="name"
                                item-value="id"
                                :clearable="true"
                                @click:clear="data.property = null"
                                :rules="rules.property"
                            >
                            </v-select>
                        </v-col>
                        <v-col cols="12" sm="12" md="4" class="mt-n6">
                            <v-text-field
                                v-model="data.price"
                                outlined
                                :rules="rules.price"
                                label="Harga"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" class="mt-n6">
                            <v-textarea
                                v-model="data.statusSurat"
                                label="Status Surat"
                                outlined
                                :rules="rules.statusSurat"
                                placeholder="Status Surat (Tanpa Enter)"
                            ></v-textarea>
                        </v-col>
                        <v-col cols="12" class="mt-n6">
                            <v-textarea
                                v-model="data.kelengkapanSurat"
                                label="Kelengkapan Surat"
                                outlined
                                :rules="rules.kelengkapanSurat"
                                placeholder="Kelengkapan Surat (Tanpa Enter)"
                            ></v-textarea>
                        </v-col>
                        <v-col cols="12" class="mt-n6">
                            <v-textarea
                                v-model="data.specification"
                                label="Spesifikasi Rumah"
                                outlined
                                :rules="rules.specification"
                                placeholder="Spesifikasi Rumah yang Dipasarkan (Tanpa Enter)"
                            ></v-textarea>
                        </v-col>
                        <v-col cols="12" class="text-center">
                            <v-btn class="blue white--text" x-large width="10%" @click="send">Daftar</v-btn>
                        </v-col>
                    </v-row>
                </v-form>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>

import api from '@/api'

export default {
    data() {
        return {
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
            data: {
                name:'',
                phoneNumber:'',
                email:'',
                ownerAddress:'',
                address:'',
                area:'',
                specification:'',
                statusSurat:'',
                price:'',
                property:'',
                kelengkapanSurat:''
            },
            phone:'',
            rules: {
                name: [
                    v => !!v || 'Nama Harus Diisi',
                    v => v.length <50 || 'Maksimal 50 Karakter'
                ],
                phoneNumber: [
                    v => !!v || 'Nomor Harus Diisi'
                ],
                email: [
                    v => !!v || 'Lokasi Harus Diisi',
                    v => /.+@.+\..+/.test(v) || 'E-mail Tidak Valid',
                ],
                ownerAddress: [
                    v => !!v || 'Alamat Pendaftar Harus Diisi'
                ],
                address: [
                    v => !!v || 'Alamat Harus Diisi'
                ],
                area: [
                    v => !!v || 'Luas Bangunan Harus Diisi',
                    v => v >= 0 || 'Luas Bangunan Tidak Valid'
                ],
                specification: [
                    v => !!v || 'Spesifikasi Harus Diisi',
                ],
                property: [
                    v => !!v || 'Jenis Properti Harus Diisi',
                ],
                price: [
                    v => !!v || 'Harga Harus Diisi',
                    v => v>0 || 'Tidak Valid'
                ],
                kelengkapanSurat: [
                    v => !!v || 'Kelengkapan Surat Harus Diisi',
                ],
                statusSurat: [
                    v => !!v || 'Status Surat Harus Diisi',
                ]
            },
        }
    },

    mounted() {
        api.getAllAbout() 
            .then((response) => {
                this.phone = response[0].phone
            })
    },

    methods: {
        send() {
            if(this.$refs.form.validate()) {
                window.open('https://api.whatsapp.com/send?phone=+62'+this.phone+'&text=[Daftar Mitra]%0aNama: '+this.data.name+'%0aNomor Yang Bisa Dihubungi: '+this.data.phoneNumber+'%0aEmail: '+this.data.email+'%0aAlamat Rumah Pemilik: '+this.data.ownerAddress+'%0aAlamat Rumah yang Ingin Dijual/Disewa: '+this.data.address+'%0aLuas Bangunan: '+this.data.area+'%0aJenis Properti: '+this.data.property+'%0aHarga: Rp'+this.convertCurr(this.data.price)+'%0aStatus Surat:'+this.data.statusSurat+'%0aKelengkapan Surat: '+this.data.kelengkapanSurat+'%0aSpesifikasi Rumah: '+this.data.specification);
            }
        },
        convertCurr(val) {
            let temp = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'IDR' }).format(val)
            return temp.slice(0, -7)
        }
    }
}
</script>

<style>

</style>