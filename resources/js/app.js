import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { createVuetify,  } from 'vuetify';
import {VDataTable} from "vuetify/labs/components";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

const vuetify = createVuetify({
    components: {
        VDataTable,
        // Add other Vuetify components that you want to use globally
    },
    // Configure your Vuetify theme if needed
    theme: {
        // Specify your theme options
    },
});

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(vuetify)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
