<template>
    <v-app-bar dark app flat color="primary" class="absolute px-2" v-if="!breakPoint">
        <v-btn icon class="pa-1"><v-img src="@/assets/logo-white.png" contain width="40"></v-img></v-btn>
        <v-toolbar-title><span class="changeFont">CariRumah</span></v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-title class="mr-10"><span class="hoverMenuPromo orange--text" @click="$vuetify.goTo('#promo')"><v-icon class="orange--text">mdi-brightness-percent</v-icon>Promo</span></v-toolbar-title>
        <v-toolbar-title class="mr-10"><span :class="[this.$route.name == 'Products' ? 'selectedMenu' : 'hoverMenu']">Produk</span></v-toolbar-title>
        <v-toolbar-title><span :class="[this.$route.name == 'Contact' ? 'selectedMenu' : 'hoverMenu']">Contact Us</span></v-toolbar-title>
    </v-app-bar>
    <v-app-bar v-else dark app flat color="primary" class="absolute px-2">
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"/>
        <v-spacer></v-spacer>
        <v-btn icon class="pa-1"><v-img src="@/assets/logo-white.png" contain width="40"></v-img></v-btn>
        <v-toolbar-title><span class="changeFont">CariRumah</span></v-toolbar-title>
        <v-spacer></v-spacer>
        <v-app-bar-nav-icon color="transparent"/>
    </v-app-bar>

</template>

<script>
export default {
    
    name: 'NavigationBar',

    data() {
        return {
            drawer: false,
        }
    },

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
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap');
    .changeFont {
        font-family: 'Open Sans', sans-serif;
    }
    .selectedMenu {
        cursor: pointer
    }
    .selectedMenu:after {
        content: '';
        display: block;
        margin: auto;
        height: 3px;
        width: 100%;
        background: white;
        transition: width .5s ease, background-color .5s ease;
    }
    .hoverMenu {
        cursor: pointer
    }
    .hoverMenu:after {
        content: '';
        display: block;
        margin: auto;
        height: 3px;
        width: 0px;
        background: transparent;
        transition: width .5s ease, background-color .5s ease;
    }
    .hoverMenu:hover:after {
        width: 100%;
        background: white;
    }
    .hoverMenuPromo {
        cursor: pointer
    }
    .hoverMenuPromo:after {
        content: '';
        display: block;
        margin: auto;
        height: 3px;
        width: 0px;
        background: transparent;
        transition: width .5s ease, background-color .5s ease;
    }
    .hoverMenuPromo:hover:after {
        width: 100%;
        background: orange;
    }
</style>