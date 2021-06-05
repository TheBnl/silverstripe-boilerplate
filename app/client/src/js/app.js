import Vue from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue'
import Layout from './Layout/Layout'

createInertiaApp({
  resolve: name => {
    const page = require(`./Pages/${name}`).default;
    page.layout = page.layout || Layout;
    return page;
  },
  setup({ el, app, props }) {
    new Vue({
      render: h => h(app, props),
    }).$mount(el)
  },
})
