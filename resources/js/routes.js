import VueRouter from "vue-router";
import Bookables from "./bookables/Bookables";
import Bookable from "./bookable/Bookable";
import Media from "./bookable/Media";

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
];

const router = new VueRouter({
    routes,
    mode: "history",
});

export default router;
