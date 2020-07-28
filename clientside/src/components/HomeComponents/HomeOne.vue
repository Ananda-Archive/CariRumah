<template>
    <v-container fluid fill-height style="height:100vh;background:#1E68E8">
            <v-row align="center" justify="center">
                <v-col cols="12">
                    <v-row justify="center"><v-img src="@/assets/logo-white.png" max-width="200px"></v-img></v-row>
                </v-col>
                <v-col cols="12" sm="12" md="7" class="mt-4">
                    <v-autocomplete
                        solo
                        label="Cari Provinsi"
                        v-model="search"
                        :items="getProvince"
                        :auto-select-first="true"
                        item-text="nama"
                        :search-input.sync="searchSync"
                        :readonly="search != null"
                    >
                        <template v-slot:prepend-inner><v-icon @click="search = null" v-if="search != null" class="primary--text mr-2" style="cursor:pointer">mdi-close</v-icon></template>
                        <template v-slot:append><v-icon :disabled="search == null" large class="primary--text" style="cursor:pointer">mdi-magnify mdi-flip-h</v-icon></template>
                    </v-autocomplete>
                </v-col>
            </v-row>
    </v-container>
</template>

<script>
export default {
    name: 'HomeOne',

    data() {
        return {
            search:null,
            searchSync:''
        }
    },

    computed: {
        getProvince() {
            return this.$store.state.province.province
        }
    }
}
</script>

<style>
</style>