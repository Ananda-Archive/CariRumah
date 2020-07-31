<template>
    <div v-if="!this.$route.meta.auth">
        <v-app-bar dark app flat color="primary" class="absolute px-2" v-if="!breakPoint && this.$route.name != 'Login'">
            <v-btn icon class="pa-1" @click="goTo('/')"><v-img src="@/assets/logo-white.png" contain width="40"></v-img></v-btn>
            <v-toolbar-title @click="goTo('/')"><span style="cursor:pointer" class="changeFont">CariRumah</span></v-toolbar-title>
            <v-spacer></v-spacer>
            <!-- <v-toolbar-title class="mr-10"><span class="hoverMenuPromo orange--text" @click="$vuetify.goTo('#promo')"><v-icon class="orange--text">mdi-brightness-percent</v-icon>Promo</span></v-toolbar-title> -->
            <v-toolbar-title class="mr-10" @click="goTo('/Products')"><span :class="[this.$route.name == 'Products' ? 'selectedMenu' : 'hoverMenu']">Produk</span></v-toolbar-title>
            <v-toolbar-title class="mr-10" @click="goTo('/Credit')"><span :class="[this.$route.name == 'Credit' ? 'selectedMenu' : 'hoverMenu']">Simulasi Kredit</span></v-toolbar-title>
            <v-toolbar-title class="mr-10" @click="goTo('/Registration')"><span :class="[this.$route.name == 'Registration' ? 'selectedMenu' : 'hoverMenu']">Registrasi</span></v-toolbar-title>
            <v-toolbar-title><span :class="[this.$route.name == 'Contact' ? 'selectedMenu' : 'hoverMenu']">Tentang Kami</span></v-toolbar-title>
        </v-app-bar>
        <v-app-bar v-else-if="breakPoint && this.$route.name != 'Login'" dark app flat color="primary" class="absolute px-2">
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"/>
            <v-spacer></v-spacer>
            <v-btn icon class="pa-1"><v-img src="@/assets/logo-white.png" contain width="40"></v-img></v-btn>
            <v-toolbar-title><span class="changeFont">CariRumah</span></v-toolbar-title>
            <v-spacer></v-spacer>
            <v-app-bar-nav-icon color="transparent"/>
        </v-app-bar>
        <v-navigation-drawer app dark v-model="drawer">
            <v-list dense>
                <!-- <v-list-item link @click="$vuetify.goTo('#promo')">
                    <v-list-item-icon><v-icon class="orange--text">mdi-brightness-percent</v-icon></v-list-item-icon>
                    <v-list-item-title class="orange--text">Promo</v-list-item-title>
                </v-list-item> -->
                <v-list-item link @click="goTo('/Products')">
                    <v-list-item-icon><v-icon>mdi-home-search</v-icon></v-list-item-icon>
                    <v-list-item-title>Produk</v-list-item-title>
                </v-list-item>
                <v-list-item link @click="goTo('/Products')">
                    <v-list-item-icon><v-icon>mdi-calculator</v-icon></v-list-item-icon>
                    <v-list-item-title>Simulasi Kredit</v-list-item-title>
                </v-list-item>
                <v-list-item link @click="goTo('/Products')">
                    <v-list-item-icon><v-icon>mdi-form-select</v-icon></v-list-item-icon>
                    <v-list-item-title>Registrasi</v-list-item-title>
                </v-list-item>
                <v-list-item link>
                    <v-list-item-icon><v-icon>mdi-account-multiple</v-icon></v-list-item-icon>
                    <v-list-item-title>Tentang Kami</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
    </div>
    <div v-else>
        <v-app-bar app dark class="absolute d-lg-none" color="primary" v-if="this.$route.name != 'Login'">
            <v-app-bar-nav-icon @click.stop="drawerAdmin = !drawerAdmin"/>
            <v-spacer></v-spacer>
            <v-btn icon class="pa-1"><v-img src="@/assets/logo-white.png" contain width="40"></v-img></v-btn>
            <v-toolbar-title><span class="changeFont">CariRumah Admin</span></v-toolbar-title>
            <v-spacer></v-spacer>
            <v-app-bar-nav-icon color="transparent"/>
        </v-app-bar>
        <v-navigation-drawer app dark v-model="drawerAdmin" v-if="this.$route.name != 'Login'">
            <v-layout justify-space-between column fill-height>
                <div>
                    <template>
                        <v-list-item class="my-2">
                            <v-list-item-avatar size="60">
                                <img src="https://image.flaticon.com/icons/svg/194/194938.svg" alt="">
                            </v-list-item-avatar>
                            <v-list-item-content>
                                <v-list-item-title>Admin</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                    <v-divider></v-divider>
                    <v-list dense>
                        <v-list-item link @click="goTo('/Dashboard')">
                            <v-list-item-icon><v-icon :class="[this.$route.name=='Dashboard' ? 'primary--text' : '']">mdi-folder-home</v-icon></v-list-item-icon>
                            <v-list-item-title :class="[this.$route.name=='Dashboard' ? 'primary--text' : '']">Produk</v-list-item-title>
                        </v-list-item>
                        <!-- <v-list-item link @click="goTo('/AdminMitra')">
                            <v-list-item-icon><v-icon :class="[this.$route.name=='AdminMitra' ? 'primary--text' : '']">mdi-account-group</v-icon></v-list-item-icon>
                            <v-list-item-title :class="[this.$route.name=='AdminMitra' ? 'primary--text' : '']">Daftar Mitra</v-list-item-title>
                        </v-list-item>
                        <v-list-item link @click="goTo('/AdminAgent')">
                            <v-list-item-icon><v-icon :class="[this.$route.name=='AdminAgent' ? 'primary--text' : '']">mdi-account-multiple-check</v-icon></v-list-item-icon>
                            <v-list-item-title :class="[this.$route.name=='AdminAgent' ? 'primary--text' : '']">Daftar Agen</v-list-item-title>
                        </v-list-item>
                        <v-list-item link>
                            <v-list-item-icon><v-icon :class="[this.$route.name=='AdminSeminar' ? 'primary--text' : '']">mdi-account-tie-voice</v-icon></v-list-item-icon>
                            <v-list-item-title :class="[this.$route.name=='AdminSeminar' ? 'primary--text' : '']">Daftar Seminar</v-list-item-title> -->
                        <!-- </v-list-item> -->
                    </v-list>
                </div>
                <div justify-end>
                    <v-divider></v-divider>
                    <v-list dense>
                        <v-list-item link>
                            <v-list-item-icon><v-icon class="red--text">mdi-power</v-icon></v-list-item-icon>
                            <v-list-item-title class="red--text">Logout</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </div>
            </v-layout>
        </v-navigation-drawer>
    </div>
</template>

<script>
export default {
    
    name: 'NavigationBar',

    data() {
        return {
            drawer: false,
            drawerAdmin: null
        }
    },

    methods: {
        goTo(path) {
            this.$router.push(path)
            window.scroll(0,0)
        },
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