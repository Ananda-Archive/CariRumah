<template>
    <v-app>
        <v-content class="ma-12">
            <v-container fill-height fluid>
                <v-row justify-center align-center>
                    <v-col cols="12" class="text-center">
                        <v-row no-gutters class="justify-center">
                            <v-col cols="12" sm="12" md="3">
                                <v-card flat link  @click="goTo('/Registration/Mitra')">
                                    <v-alert outlined color="primary">
                                        <v-icon class="primary--text" size="150">mdi-account-group</v-icon>
                                        <v-card-title class="justify-center">Pendaftaran Mitra</v-card-title>
                                    </v-alert>
                                </v-card>
                            </v-col>
                            <v-col cols="1"></v-col>
                            <v-col cols="12" sm="12" md="3">
                                <v-card flat link  @click="test">
                                    <v-alert outlined color="primary">
                                        <v-icon class="primary--text" size="150">mdi-account-multiple-check</v-icon>
                                        <v-card-title class="justify-center">Pendaftaran Agen</v-card-title>
                                    </v-alert>
                                </v-card>
                            </v-col>
                            <v-col cols="1"></v-col>
                            <v-col cols="12" sm="12" md="3">
                                <v-card flat link  @click="test">
                                    <v-alert outlined color="primary">
                                        <v-icon class="primary--text" size="150">mdi-account-tie-voice</v-icon>
                                        <v-card-title class="justify-center">Pendaftaran Seminar</v-card-title>
                                    </v-alert>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
export default {

    methods: {
        goTo(path) {
            this.$router.push(path)
            window.scroll(0,0)
        },
    },

}
</script>

<style>

</style>