require('./bootstrap');

import VueRouter from "vue-router";
import router from "./routes";
import Index from "./Index";
import moment from "moment";
import StarRating from "./shared/components/StarRating";
import Error from "./shared/components/alerts/Error";
import Warning from "./shared/components/alerts/Warning";
import ValidationErrors from "./shared/components/ValidationErrors";

window.Vue = require('vue');
Vue.use(VueRouter);

Vue.filter("fromNow", value => moment(value).fromNow());

Vue.component("star-rating", StarRating);
Vue.component("error", Error);
Vue.component("warning", Warning);
Vue.component("validation-errors", ValidationErrors);

const app = new Vue({
    el: '#app',
    router,
    components: {
        "index": Index
    }
});
