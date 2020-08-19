<template>
    <v-app>
        <v-content class="ma-md-12">
            <div>
                <v-container>
                    <v-form ref="form">
                        <v-row>
                            <v-col cols="12">
                                <h1 class="font-weight-medium">SIMULASI KPR</h1>
                                <v-divider class="my-4"></v-divider>
                            </v-col>
                            <v-col cols="12" sm="12" md="5">
                                <v-text-field
                                    label="Pinjaman"
                                    outlined
                                    placeholder="contoh: 500000000"
                                    v-model="data.loan"
                                    :rules="rules.loan"
                                >
                                    <template v-slot:prepend-inner><span class="mr-2 mt-1 primary--text font-weight-bold">Rp</span></template>
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" sm="12" md="2" class="mt-n6 mt-md-0">
                                <v-text-field
                                    label="Tenor (Jangka Waktu)"
                                    outlined
                                    placeholder="contoh: 3"
                                    v-model="data.tenor"
                                    :rules="rules.tenor"
                                >
                                    <template v-slot:append><span class="mr-2 mt-1 primary--text font-weight-bold">Tahun</span></template>
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" sm="12" md="2" class="mt-n6 mt-md-0">
                                <v-text-field
                                    label="Uang Muka (DP)"
                                    outlined
                                    placeholder="contoh: 20"
                                    v-model="data.dp"
                                    :rules="rules.dp"
                                >
                                    <template v-slot:append><span class="mr-2 mt-1 primary--text font-weight-bold">%</span></template>
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" sm="12" md="3" class="mt-n6 mt-md-0">
                                <v-text-field
                                    label="Bunga"
                                    outlined
                                    placeholder="contoh: 12.4"
                                    v-model="data.interest"
                                    :rules="rules.interest"
                                >
                                    <template v-slot:append><span class="mr-2 mt-1 primary--text font-weight-bold">% / Tahun</span></template>
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="text-center mt-n6">
                                <v-btn @click="calculate" large dark color="primary">Kalkulasi</v-btn>
                            </v-col>
                            <v-col cols="12" v-if="show">
                                <v-simple-table>
                                    <template v-slot:default>
                                        <thead>
                                            <tr>
                                                <th>Bulan</th>
                                                <th>Bunga</th>
                                                <th>Pokok</th>
                                                <th>Total</th>
                                                <th>Sisa Pinjaman</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(i,idx) in n" :key="idx">
                                                <td>
                                                    {{i}}
                                                </td>
                                                <td>
                                                    Rp {{convertCurr(calculateData.interest[i-1])}}
                                                </td>
                                                <td>
                                                    Rp {{convertCurr(calculateData.main[i-1])}}
                                                </td>
                                                <td>
                                                    Rp {{convertCurr(calculateData.interestAndMain)}}
                                                </td>
                                                <td>
                                                    Rp {{convertCurr(calculateData.total[i-1])}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </template>
                                </v-simple-table>
                            </v-col>
                        </v-row>
                    </v-form>
                </v-container>
            </div>
        </v-content>
    </v-app>
</template>

<script>

import _ from 'lodash'

export default {
    data() {
        return {
            /*
            PMT adalah fungsi perhitungan di excel, sama saja dengan EMI
            EMI = ( P*R*(1+R)^N ) / ( (1+R)^(N-1) - 1 )
            P = Jumlah Uang yang dipinjam (setelah dikurang dengan uang muka)
            R = Jumlah Bunga (Bunga / 12 * 100)
            N = Jumlah Bulan
            */
            data: {
                loan:null,
                tenor:null,
                dp:null,
                interest:null
            },
            emi:null,
            n:null,
            init:null,
            calculateData:{
                interest:[],
                main:[],
                interestAndMain:null,
                total:[],
                init:[]
            },
            calculateDataDefault:{
                interest:[],
                main:[],
                interestAndMain:null,
                total:[],
                init:[]
            },
            rules: {
                loan: [
                    v => !!v || 'Harus Diisi',
                    v => !isNaN(v) || 'Tidak Valid'
                ],
                tenor: [
                    v => !!v || 'Harus Diisi',
                    v => !isNaN(v) || 'Tidak Valid'
                ],
                dp: [
                    v => !!v || 'Harus Diisi',
                    v => !isNaN(v) || 'Tidak Valid'
                ],
                interest: [
                    v => !!v || 'Harus Diisi',
                    v => !isNaN(v) || 'Tidak Valid'
                ],
            },
            show: false,
        }
    },

    methods: {
        PMT(totalAmount, interest, downPayment, years) {
            var r = +interest / (12*100)
            var p = Number(+totalAmount - (+totalAmount * (+downPayment / 100)))
            var n = Number(years*12)
            this.init = p
            this.emi = Number( (p*r*Math.pow((1+r),n)) / (Math.pow((1+r),(n))-1) )
        },
        calculate() {
            if(this.$refs.form.validate()) {
                this.show = true
                this.calculateData = _.cloneDeep(this.calculateDataDefault)
                this.PMT(this.data.loan, this.data.interest, this.data.dp, this.data.tenor)
                this.n = _.clone(+this.data.tenor)*12
                this.calculateData.interestAndMain = _.clone(this.emi)
                for(let i=0; i<this.n; i++) {
                    this.calculateData.init.push(this.init)
                    var a = this.calculateData.init[i] * (+this.data.interest / (12*100))
                    var b = this.calculateData.interestAndMain - a
                    this.init = this.init - b
                    this.calculateData.total.push(this.init)
                    this.calculateData.interest.push(a)
                    this.calculateData.main.push(b)
                }
            }
        },
        convertCurr(val) {
            let temp = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'IDR' }).format(val)
            return temp.slice(0, -4)
        },
    }
}
</script>

<style>

</style>