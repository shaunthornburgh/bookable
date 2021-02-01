import VueRouter from "vue-router";
import Basket from "./basket/Basket";
import Bookables from "./bookables/Bookables";
import Bookable from "./bookable/Bookable";
import Media from "./bookable/Media";
import Review from "./review/Review";

const routes = [
    {
        path: "/",
        component: Bookables,
        name: "home",
    },
    {
        path: "/bookable/:id",
        component: Bookable,
        name: "bookable",
    },
    {
        path: "/bookable/:id/media",
        component: Media,
        name: "media",
    },
    {
        path: "/review/:id",
        component: Review,
        name: "review"
    },
    {
        path: "/basket",
        component: Basket,
        name: "basket"
    },
    {
        path: "/auth/login",
        component: require("./auth/Login").default,
        name: "login"
    }
];

const router = new VueRouter({
    routes,
    mode: "history",
});

export default router;
