<template>
    <v-app>
            <home-one></home-one>
            <home-two></home-two>
            <home-three></home-three>
            <whatsapp-floating-button></whatsapp-floating-button>
            <footer-layout></footer-layout>
    </v-app>
</template>

<script>

// Component Import
import HomeOne from '@/components/HomeComponents/HomeOne.vue'
import HomeTwo from '@/components/HomeComponents/HomeTwo.vue'
import HomeThree from '@/components/HomeComponents/HomeThree.vue'
import WhatsappFloatingButton from '@/components/WhatsAppFloatingButton.vue'
import FooterLayout from '@/components/FooterLayout.vue'

export default {
    name: 'Home',

    components: {
        HomeOne,
        HomeTwo,
        HomeThree,
        WhatsappFloatingButton,
        FooterLayout
    }
}
</script>

<style>
/* body::-webkit-scrollbar {
    display: none; 
}
body {
  -ms-overflow-style: none; 
  scrollbar-width: none; 
} */
</style>