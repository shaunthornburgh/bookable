<template>
    <div v-if="!loading">
        <gallery :bookable-id="this.$route.params.id"></gallery>
        <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:w-full sm:mb-64 mb-10 flex flex-col">
            <div class="col-start-1 col-end-3 w-full">
                <div class="bg-white shadow sm:rounded-lg mb-7">
                    <div class="px-4 py-5 sm:px-6">
                        <h2 id="bookable-details-title" class="text-lg leading-6 font-medium text-gray-900">{{ bookable.title }}</h2>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                        <p>{{ bookable.description }}</p>
                    </div>
                </div>
                <review-list :bookable-id="this.$route.params.id"></review-list>
            </div>
            <div class="md:col-span-1">
                <availability
                    :bookable-id="this.$route.params.id"
                    @availability="checkPrice($event)"
                    class="mb-4"
                ></availability>

                <transition name="fade">
                    <price-breakdown v-if="price" :price="price" class="mb-4"></price-breakdown>
                </transition>

                <transition name="fade">
                    <div class="sm:pl-3">
                        <button
                            type="button"
                            class="justify-center inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 w-full"
                            v-if="price"
                        >Book now</button>
                    </div>
                </transition>
            </div>
        </div>
    </div>
    <div v-else>Loading ...</div>
</template>

<script>
    import Availability from "./Availability";
    import Gallery from "./Gallery";
    import ReviewList from "./ReviewList";
    import { mapState } from "vuex";
    import PriceBreakdown from "./PriceBreakdown";

    export default {
        components: {
            Availability,
            Gallery,
            ReviewList,
            PriceBreakdown
        },
        data() {
            return {
                bookable: null,
                loading: false,
                price: null,
            }
        },
        created() {
            this.loading = true;
            axios
                .get(`/api/bookables/${this.$route.params.id}`)
                .then(response => {
                    this.bookable = response.data.data;
                    this.loading = false;
                });
        },
        computed: mapState({
            lastSearch: "lastSearch"
        }),
        methods: {
            async checkPrice(hasAvailability) {
                if (!hasAvailability) {
                    this.price = null;
                    return;
                }

                try {
                    this.price = (await axios.get(
                        `/api/bookables/${this.bookable.id}/price?from=${this.lastSearch.from}&to=${this.lastSearch.to}`
                    )).data.data;
                } catch (err) {
                    this.price = null;
                }
            }
        }
    };
</script>
