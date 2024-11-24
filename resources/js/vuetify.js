import Vue from "vue";
import Vuetify from "vuetify/lib";

Vue.use(Vuetify);

const opts = {
  theme: {
    dark: true,
    themes: {
      dark: {
        primary: "#ff010a",
      },
    },
  },
};

export default new Vuetify(opts);
