import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import Vue3Toastify  from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'
import { Notification } from './Plugins/Notifications';

const appName = import.meta.env.VITE_APP_NAME || 'Job-Seeker';

createInertiaApp({
    title: (title) => `${title} | ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(Notification)
            .use(Vue3Toastify)
            .mount(el);
    },
    progress: {
        color: '#3b82f6',
    },
});
