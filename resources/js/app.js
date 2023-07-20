require('./bootstrap');

//require('moment')

// Import modules...
import Vue from 'vue';
import {
    App as InertiaApp,
    plugin as InertiaPlugin
} from '@inertiajs/inertia-vue';
import PortalVue from 'portal-vue';
import vuetify from './Plugins/vuetify'
import axios from 'axios'
Vue.mixin({
    methods: {
        route
    }
});
Vue.use(InertiaPlugin);
Vue.use(PortalVue);

const app = document.getElementById('app');

new Vue({
    vuetify,
    axios,
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
