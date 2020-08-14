<template>
    <v-app>
        <v-content class="ma-12">
            <v-container fluid>
                <v-form ref="form">
                    <v-row>
                        <v-col cols="12">
                            <h1 class="font-weight-medium">DAFTAR SEMINAR</h1>
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
export default {
    data() {
        return {
            data: {
                name:'',
                phoneNumber:'',
                email:'',
                ownerAddress:'',
                address:'',
                area:'',
                specification:''
            },
            phone:'+6287731492139',
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
            },
        }
    },

    methods: {
        send() {
            if(this.$refs.form.validate()) {
                window.open('https://api.whatsapp.com/send?phone='+this.phone+'&text=[Daftar Mitra]%0aNama: '+this.data.name+'%0aNomor Yang Bisa Dihubungi: '+this.data.phoneNumber+'%0aEmail: '+this.data.email+'%0aAlamat Rumah Pemilik: '+this.data.ownerAddress+'%0aAlamat Rumah yang Ingin Dijual/Disewa: '+this.data.address+'%0aLuas Bangunan: '+this.data.area+'%0aSpesifikasi Rumah: '+this.data.specification);
            }
        }
    }
}
</script>

<style>

</style>