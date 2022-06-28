require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { ZiggyVue } from 'ziggy';
import { Ziggy } from './ziggy';

import 'flowbite';

//import '@coreui/coreui/dist/css/coreui.min.css';

//import PortalVue from 'portal-vue';
//import Notifications from 'vue-notification'

//Vue.use(require('vue-moment'));
//Vue.use(Notifications)
//Vue.use(InertiaApp);
//Vue.use(PortalVue);

const app = document.getElementById('app');

createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .mount(el)
    },
});

InertiaProgress.init({ color: '#4B5563' });
