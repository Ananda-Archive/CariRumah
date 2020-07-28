<template>
    <v-tooltip left>
        
        <template v-slot:activator="{ on, attrs }">
            <v-btn v-bind="attrs" v-on="on" fab dark large color="whatsapp" fixed right bottom class="mr-3 mb-2" @click="messageMe">
                <v-icon x-large>mdi-whatsapp</v-icon>
            </v-btn>
        </template>
        <span>Hubungi Kami</span>
    </v-tooltip>
</template>

<script>
export default {
    data() {
        return {
            phone:'+6287731492139'
        }
    },

    methods: {
        messageMe() {
            window.open('https://api.whatsapp.com/send?phone='+this.phone,'_blank');
        }
    }
}
</script>

<style>

</style>