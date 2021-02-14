<template>
    <div>
        <div v-if = "loading">
            Data is loading
        </div>
        <div v-else>
            <div class="mt-10 sm:mt-12">
                <form action="#" class="">
                    <div class="sm:flex">
                        <div class="min-w-0 flex-1">
                            <label for="location" class="sr-only">Where would you like to stay?</label>
                            <input id="location" type="location" placeholder="Where would you like to stay?" class="block w-full border border-gray-300 rounded-md px-5 py-3 text-base text-gray-900 placeholder-gray-500 shadow-sm focus:border-rose-500 focus:ring-indigo-500">
                        </div>
                        <div class="mt-3 sm:mt-0 sm:ml-3">
                            <button type="submit" class="block w-full py-3 px-4 rounded-md inline-flex items-center justify-center border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="mt-12 grid gap-5 max-w-lg mx-auto lg:grid-cols-3 lg:max-w-none">
                <bookable-list-item
                    v-bind="bookable"
                    v-for="(bookable, index) in bookables"
                    :key="index"
                ></bookable-list-item>
            </div>
        </div>
    </div>
</template>

<script>
    import BookableListItem from "./BookableListItem";

    export default {
        components: {
            BookableListItem
        },
        data() {
            return {
                bookables: null,
                loading: false
            }
        },
        created() {
            this.loading = true;

            const request = axios
                .get('/api/bookables')
                .then(response => {
                    this.bookables = response.data.data;
                    this.loading = false;
                });
        }
    }
</script>
