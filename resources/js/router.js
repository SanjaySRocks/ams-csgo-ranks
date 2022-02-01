import Vue from "vue";
import VueRouter from "vue-router";
import Points from "./components/Points.vue";
import Dashboard from "./components/Dashboard.vue";
import Kills from "./components/Kills.vue";
import Deaths from "./components/Deaths.vue";
import Headshots from "./components/Headshots.vue";
import Knifes from "./components/Knifes.vue";
import Player from "./components/Player.vue";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        name: "home",
        component: Dashboard,
    },
    {
        path: "/points",
        name: "points",
        component: Points,
        props: {
            title: "Points Table",
        },
    },
    {
        path: "/kills",
        name: "kills",
        component: Kills,
    },
    {
        path: "/deaths",
        name: "deaths",
        component: Deaths,
    },
    {
        path: "/headshots",
        name: "headshots",
        component: Headshots,
    },
    {
        path: "/knifes",
        name: "knifes",
        component: Knifes,
    },
    {
        path: "/player/:id",
        name: "player",
        component: Player,
        //props: true,
    },
];

const router = new VueRouter({
    mode: "history",
    routes: routes,
});

export default router;
