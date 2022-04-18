require('./bootstrap');

import Vue from 'vue'
import VueRouter from "vue-router";
import Vuex from 'vuex';
import router from "./routes";
import Index from "./Index";
import moment from "moment";
import StarRating from "./shared/components/StarRating";
import Error from "./shared/components/alerts/Error";
import Warning from "./shared/components/alerts/Warning";
import Success from "./shared/components/alerts/Success";
import ValidationErrors from "./shared/components/ValidationErrors";
import storeDefinition from "./store";

// window.Vue = require('vue');
Vue.use(VueRouter);
Vue.use(Vuex);

Vue.filter("fromNow", value => moment(value).fromNow());

Vue.component("star-rating", StarRating);
Vue.component("error", Error);
Vue.component("warning", Warning);
Vue.component("success", Success);
Vue.component("validation-errors", ValidationErrors);

const store = new Vuex.Store(storeDefinition);

window.axios.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (401 === error.response.status) {
            store.dispatch("logout");
        }

        return Promise.reject(error);
    }
);

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        "index": Index
    },
    async beforeCreate() {
        this.$store.dispatch("loadStoredState");
        this.$store.dispatch("loadUser");
    }
});
