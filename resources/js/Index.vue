<template>
    <div>
        <nav-bar></nav-bar>
        <main>
            <div class="min-h-screen bg-gray-200 antialiased xl:flex xl:flex-col xl:h-screen">
                <router-view></router-view>
            </div>
        </main>
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

