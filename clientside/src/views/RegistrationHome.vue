<template>
    <v-app>
        <router-view></router-view>
        <whatsapp-floating-button></whatsapp-floating-button>
    </v-app>
</template>

<script>

import WhatsappFloatingButton from '@/components/WhatsAppFloatingButton.vue'

export default {

    components: {
        WhatsappFloatingButton
    }

}
</script>

<style>

</style>