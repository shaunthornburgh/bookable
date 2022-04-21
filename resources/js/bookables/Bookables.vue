<template>
    <div class="xl:flex-1 xl:flex xl:overflow-y-hidden">
        
        <main class="pt-6 xl:flex-1 xl:overflow-x-hidden">
            <div class="px-4 xl:px-8"><h3 class="text-gray-900 text-xl">Where do you want to stay</h3><p class="text-gray-600">Probably we need some header here</p></div>
        <div v-if = "loading">
            Data is loading
        </div>
        <div id="bookablesContainerStart" v-else>
            <div class="mt-6 px-4 grid gap-5 mx-auto grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 2xl:grid-cols-4 lg:max-w-none">
                <bookable-list-item
                    v-bind="bookable"
                    v-for="(bookable, index) in bookables"
                    :key="index"
                ></bookable-list-item>
            </div>
        </div>
        <Pagination @change-page="$emit('change-page')"/>
        </main>
    </div>
</template>

<script>
    import { mapState } from "vuex";
    import BookableListItem from "./BookableListItem";
    import Pagination from "../navigation/Pagination";
    

    export default {
        components: {
            BookableListItem,
            Pagination
        },
        data() {
            return {
                filters: null,
                loading: false,
                selectedFilters: null
            }
        },
        computed: {
            ...mapState(['bookables'])
        },
    }
</script>
