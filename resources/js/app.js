// Import modules...
window._ = require("lodash");
import Vue from "vue";
import vuetify from "./vuetify"; // path to vuetify export

import VueTilt from "vue-tilt.js";
Vue.use(VueTilt);

import AOS from "aos";

AOS.init({
  offset: 1,
  duration: 800,
  once: true,
});

import { createInertiaApp, Link } from "@inertiajs/inertia-vue";
import { InertiaProgress } from "@inertiajs/progress";
InertiaProgress.init({ color: "#b1a460", showSpinner: true });

Vue.filter("date", function(date) {
  return date.toLocaleDateString();
});

Vue.component("inertia-link", Link);
Vue.component("router-link", {
  functional: true,
  render(h, context) {
    const data = { ...context.data };
    delete data.nativeOn;
    const props = data.props || {};
    props.href = props.to; /// v-btn passes `to` prop but inertia-link requires `href`, so we just copy it
    return h("inertia-link", data, context.children);
  },
});

// Components
const files = require.context("./", true, /\.vue$/i);
files.keys().map((key) =>
  Vue.component(
    key
      .split("/")
      .pop()
      .split(".")[0],
    files(key).default
  )
);

import { Head } from "@inertiajs/inertia-vue";
Vue.component("Head", Head);

Vue.prototype.route = route;

import Layout from "./Shared/layout";

createInertiaApp({
  resolve: (name) => {
    const page = require(`./Pages/${name}`).default;
    page.layout = page.layout || Layout;
    return page;
  },
  setup({ App, props }) {
    new Vue({
      vuetify,
      render: (h) => h(App, props),
    }).$mount("#app");
  },
  title: (title) => `${title} - Mystery Fun House`,
});
