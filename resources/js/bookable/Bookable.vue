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
                            @click="addToBasket"
                            v-if="price"
                            :disabled="inBasketAlready"
                        >Book now</button>
                    </div>
                </transition>

                <div class="sm:pl-3 sm:my-3" v-if="inBasketAlready">
                    <button
                        type="button"
                        class="justify-center inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 w-full"
                        @click="removeFromBasket"
                    >Remove from basket</button>
                </div>

                <div v-if="inBasketAlready" class="rounded-md bg-yellow-50 p-4 sm:ml-3">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" x-description="Heroicon name: exclamation" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <div class="mt-2 text-sm text-yellow-700">
                                <p>
                                    It seems like you've added this object to basket already. If you want to change dates, remove from the basket first.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div

                    class="mt-4 text-muted warning"
                ></div>
            </div>
        </div>
    </div>
    <div v-else>Loading ...</div>
</template>

<script>
    import Availability from "./Availability";
    import Gallery from "./Gallery";
    import ReviewList from "./ReviewList";
    import { mapState, mapGetters } from "vuex";
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
        computed: {
            ...mapState({
                lastSearch: "lastSearch"
            }),
            inBasketAlready() {
                if (null === this.bookable) {
                    return false;
                }

                return this.$store.getters.inBasketAlready(this.bookable.id);
            }
        },
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
            },
            addToBasket() {
                this.$store.commit("addToBasket", {
                    bookable: this.bookable,
                    price: this.price,
                    dates: this.lastSearch
                });
            },
            removeFromBasket() {
                this.$store.commit("removeFromBasket", this.bookable.id);
            }
        }
    };
</script>
