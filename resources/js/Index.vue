<template>
    <div class="min-h-screen bg-gray-200 antialiased xl:flex xl:flex-col xl:h-screen">
        <nav-bar></nav-bar>
        <div class="xl:flex-1 xl:flex xl:overflow-y-hidden">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import { mapState } from "vuex";
    import NavBar from "./navigation/NavBar";

    export default {
        components: {
            NavBar,
        },
        data() {
            return {
                lastSearch: this.$store.state.lastSearch
            };
        },
        computed: {
            ...mapState({
                lastSearchComputed: "lastSearch",
            })
        }
    };
</script>

