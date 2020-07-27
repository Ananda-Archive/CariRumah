<template>
     <v-parallax
        id="promo"
        :height="breakPoint ? 600 : 500"
        src="@/assets/promo.jpg"
     >
        <v-container fill-height>
            <v-overlay opacity="0.8" :absolute="true"></v-overlay>
            <v-row class="mx-auto" style="z-index:10000">
                <v-col cols="12" class="text-center changeFont">
                    <h2>KATALOG PROMO</h2>
                </v-col>
                <v-col cols="12">
                    <div class="text-center">
                        <v-btn large outlined dark>
                            <span>SELENGKAPNYA<v-icon class="ml-1">mdi-open-in-new</v-icon></span>
                        </v-btn>
                    </div>
                </v-col>
            </v-row>
        </v-container>
     </v-parallax>
</template>

<script>
export default {
    name: 'HomeTwo',

    computed: {
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