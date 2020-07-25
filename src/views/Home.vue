<template>
    <v-app>
        <v-content>
            <home-one></home-one>
            <!-- <home-two></home-two> -->
            <whatsapp-floating-button></whatsapp-floating-button>
        </v-content>
    </v-app>
</template>

<script>

// Component Import
import HomeOne from '@/components/HomeComponents/HomeOne.vue'
// import HomeTwo from '@/components/HomeComponents/HomeTwo.vue'
import WhatsappFloatingButton from '@/components/WhatsAppFloatingButton.vue'

export default {
    name: 'Home',

    components: {
        HomeOne,
        // HomeTwo,
        WhatsappFloatingButton,

    }
}
</script>

<style>
body::-webkit-scrollbar {
    display: none; /* Hide vertical scrollbar */
}
body {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}
</style>