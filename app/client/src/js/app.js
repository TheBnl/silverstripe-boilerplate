import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import Layout from './Layout/Layout'

createInertiaApp({
  resolve: name => {
    let page;
    try {
      page = require(`./Pages/${name}`).default;
    } catch(e) {
      page = require(`./Pages/Page`).default;
    }
    
    page.layout = page.layout || Layout;
    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})