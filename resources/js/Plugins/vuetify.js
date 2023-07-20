import Vue from 'vue'

import Vuetify from 'vuetify';

import '@mdi/font/css/materialdesignicons.css'

import 'vuetify/dist/vuetify.min.css';

import colors from 'vuetify/lib/util/colors';

Vue.use(Vuetify);

export default new Vuetify({

    icons: {
        iconfont: 'mdi'
    },
    /* theme: {
        themes: {
            light: {
                primary: '#9E2810',
                secondary: 'FF2682',
                info: '#FA5198',
                accent: colors.indigo.base
            },
        },
    }, */
})
