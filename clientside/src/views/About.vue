<template>
    <v-app>
        <whatsapp-floating-button></whatsapp-floating-button>
        <v-main app class="ma-md-12 ma-8">
            <div v-html="about"></div>
        </v-main>
        <footer-layout></footer-layout>
    </v-app>
</template>

<script>

import api from '@/api'
import WhatsappFloatingButton from '@/components/WhatsAppFloatingButton.vue'
import FooterLayout from '@/components/FooterLayout.vue'

export default {
    components: {
        WhatsappFloatingButton,
        FooterLayout
    },

    data() {
        return {
            about:''
        }
    },

    mounted() {
        api.getAllAbout() 
            .then((response) => {
                this.about = response[0].about
            })
    },
}
</script>

<style>

</style>