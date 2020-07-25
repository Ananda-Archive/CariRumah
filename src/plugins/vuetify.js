import Vue from 'vue';
import Vuetify from 'vuetify/lib';

Vue.use(Vuetify);

export default new Vuetify({
    theme: {
        themes: {
            light: {
            primary: '#1E68E8',
            whatsapp: '#0DC143'
            // secondary: 'white',
            // anchor: '#8c9eff',
            },
        },
    },
});
