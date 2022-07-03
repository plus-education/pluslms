import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from 'ziggy';
import { Ziggy } from './ziggy';
import VueScreen from 'vue-screen';

import 'flowbite';

const app = document.getElementById('app');

createInertiaApp({
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue)//, Ziggy)
            .use(VueScreen, 'tailwind')
            .mount(el)
    },
});

InertiaProgress.init({ color: '#4B5563' });
