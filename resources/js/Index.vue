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
    import NavBar from "./navigation/NavBar";

    export default {
        components: {
            NavBar,
        }
    };
</script>
