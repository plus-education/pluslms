import './bootstrap';
import '../css/app.css';

import 'moment';

import { createApp, computed, h } from 'vue';
import { createInertiaApp, usePage } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from 'ziggy/vue.es.js';
import VueScreen from 'vue-screen';

import 'flowbite';

const app = document.getElementById('app');
const site_title = usePage().props;
console.log(site_title);

createInertiaApp({
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(VueScreen, 'tailwind')
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
