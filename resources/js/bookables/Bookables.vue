<template>
    <div class="xl:flex-1 xl:flex xl:overflow-y-hidden">
        <SearchFilters v-bind="filters" v-on:update-search="updateSearch"/>
        <main class="py-6 xl:flex-1 xl:overflow-x-hidden">
            <div class="px-4 xl:px-8"><h3 class="text-gray-900 text-xl">Los Angeles</h3><p class="text-gray-600">Live like the stars in these luxurious Southern California estates.</p></div>
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
    import BookableListItem from "./BookableListItem";
    import SearchFilters from "./SearchFilters";

    export default {
        components: {
            BookableListItem,
            SearchFilters
        },
        data() {
            return {
                bookables: null,
                filters: null,
                loading: false,
                selectedFilters: null
            }
        },
        methods: {
          updateSearch(selectedFilters){
            this.selectedFilters = selectedFilters
                const refreshRequest = axios
                .get('/api/bookables', {
                  params: {
                    search: 'search-string',
                    bedrooms: this.selectedFilters.bedrooms,
                    bathrooms: this.selectedFilters.bathrooms,
                    priceRange: 2000,
                    propertyType: 3,
                    amenities: '1,3,5',
                  }
                })
                .then(response => {
                    this.bookables = response.data.data;
                    this.loading = false;
                });
          },
          getBookables(){
            this.loading = true;

            const bookablesRequest = axios
                .get('/api/bookables', {
                  params: {
                    search: 'search-string',
                    bedrooms: 0,
                    bathrooms: 0,
                    priceRange: 2000,
                    propertyType: 3,
                    amenities: '1,3,5',
                  }
                })
                .then(response => {
                    this.bookables = response.data.data;
                    this.loading = false;
                });
          }
        },
        created() {
          this.getBookables()
        }
    }
</script>
