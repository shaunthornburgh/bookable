<template>
    <div>
        <nav-bar></nav-bar>
        <main>
            <div class="max-w-7xl mx-auto px-3.5 sm:px-4 lg:px-6">
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
        },
        methods: {
            async logout() {
                try {
                    axios.post("/logout");
                    this.$store.dispatch("logout");
                } catch (error) {
                    this.$store.dispatch("logout");
                }
            }
        }
    };
</script>

