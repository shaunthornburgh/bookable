<template>
    <div class="xl:flex-1 xl:flex xl:overflow-y-hidden">
        
        <main class="py-6 xl:flex-1 xl:overflow-x-hidden">
            <div class="px-4 xl:px-8"><h3 class="text-gray-900 text-xl">Where do you want to stay</h3><p class="text-gray-600">Probably we need some header here</p></div>
        <div v-if = "loading">
            Data is loading
        </div>
        <div v-else>
            <div class="mt-12 p-4 grid gap-5 max-w-lg mx-auto xl:grid-cols-3 2xl:grid-cols-4 lg:max-w-none">
                <bookable-list-item
                    v-bind="bookable"
                    v-for="(bookable, index) in bookables"
                    :key="index"
                ></bookable-list-item>
            </div>
        </div>
        </main>
    </div>
</template>

<script>
    import { mapState } from "vuex";
    import BookableListItem from "./BookableListItem";
    

    export default {
        components: {
            BookableListItem,
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
