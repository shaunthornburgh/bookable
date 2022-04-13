<template>
    <div class="max-w-7xl mx-auto px-3.5 sm:px-4 lg:px-6 mt-4">
        <success v-if="success">Congratulations on your purchase!</success>
        <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:w-full sm:mb-64 mb-10 flex flex-col" v-else>
            <div class="col-start-1 col-end-3 w-full" v-if="itemsInBasket">
                <div class="bg-white shadow sm:rounded-lg mb-7">
                    <section aria-labelledby="payment_details_heading">
                        <form action="#" method="POST">
                            <div class="shadow sm:rounded-md sm:overflow-hidden">
                                <div class="bg-white py-6 px-4 sm:p-6">
                                    <div>
                                        <h2 id="payment_details_heading" class="text-lg leading-6 font-medium text-gray-900">Payment details</h2>
                                        <p class="mt-1 text-sm text-gray-500">Update your billing information. Please note that updating your location could affect your tax rates.</p>
                                    </div>

                                    <div class="mt-6 grid grid-cols-4 gap-6">
                                        <div class="col-span-4 sm:col-span-2">
                                            <label for="first_names" class="block text-sm font-medium text-gray-700">First names</label>
                                            <input
                                                type="text"
                                                name="first_names"
                                                id="first_names"
                                                autocomplete="cc-given-name"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm"
                                                v-model="customer.first_names"
                                                :class="[{'border-red-500': errorFor('customer.first_names')}]"
                                            />
                                            <validation-errors :errors="errorFor('customer.first_names')"></validation-errors>
                                        </div>

                                        <div class="col-span-4 sm:col-span-2">
                                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last name</label>
                                            <input
                                                type="text"
                                                name="last_name"
                                                id="last_name"
                                                autocomplete="cc-family-name"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm"
                                                v-model="customer.last_name"
                                                :class="[{'border-red-500': errorFor('customer.last_name')}]"
                                            />
                                            <validation-errors :errors="errorFor('customer.last_name')"></validation-errors>
                                        </div>

                                        <div class="col-span-8 sm:col-span-4">
                                            <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                                            <input
                                                type="text"
                                                name="email"
                                                id="email"
                                                autocomplete="email"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm"
                                                v-model="customer.email"
                                                :class="[{'border-red-500': errorFor('customer.email')}]"
                                            />
                                            <validation-errors :errors="errorFor('customer.email')"></validation-errors>
                                        </div>

                                        <div class="col-span-8 sm:col-span-4">
                                            <label for="address_line_1" class="block text-sm font-medium text-gray-700">Address line 1</label>
                                            <input
                                                type="text"
                                                name="address_line_1"
                                                id="address_line_1"
                                                autocomplete="address_line_1"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm"
                                                v-model="customer.address_line_1"
                                                :class="[{'border-red-500': errorFor('customer.address_line_1')}]"
                                            />
                                            <validation-errors :errors="errorFor('customer.address_line_1')"></validation-errors>
                                        </div>

                                        <div class="col-span-8 sm:col-span-4">
                                            <label for="address_line_2" class="block text-sm font-medium text-gray-700">Address line 2</label>
                                            <input
                                                type="text"
                                                name="address_line_2"
                                                id="address_line_2"
                                                autocomplete="address_line_2"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm"
                                                v-model="customer.address_line_2"
                                                :class="[{'border-red-500': errorFor('customer.address_line_2')}]"
                                            />
                                            <validation-errors :errors="errorFor('customer.address_line_2')"></validation-errors>
                                        </div>

                                        <div class="col-span-4 sm:col-span-2">
                                            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                            <input
                                                type="text"
                                                name="city"
                                                id="city"
                                                autocomplete="cc-city"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm"
                                                v-model="customer.city"
                                                :class="[{'border-red-500': errorFor('customer.city')}]"
                                            />
                                            <validation-errors :errors="errorFor('customer.city')"></validation-errors>
                                        </div>

                                        <div class="col-span-4 sm:col-span-2">
                                            <label for="county" class="block text-sm font-medium text-gray-700">County</label>
                                            <input
                                                type="text"
                                                name="county"
                                                id="county"
                                                autocomplete="cc-county"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm"
                                                v-model="customer.county"
                                                :class="[{'border-red-500': errorFor('customer.county')}]"
                                            />
                                            <validation-errors :errors="errorFor('customer.county')"></validation-errors>
                                        </div>

                                        <div class="col-span-4 sm:col-span-2">
                                            <label for="country" class="block text-sm font-medium text-gray-700">Country / Region</label>
                                            <select
                                                id="country"
                                                name="country"
                                                autocomplete="country"
                                                class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm"
                                                v-model="customer.country"
                                                :class="[{'border-red-500': errorFor('customer.country')}]"
                                            >
                                                <option disabled value="">Please select</option>
                                                <option>Canada</option>
                                                <option>Mexico</option>
                                                <option>United Kingdom</option>
                                                <option>United States</option>
                                            </select>
                                            <validation-errors :errors="errorFor('customer.country')"></validation-errors>
                                        </div>

                                        <div class="col-span-4 sm:col-span-2">
                                            <label for="postcode" class="block text-sm font-medium text-gray-700">ZIP / Postal code</label>
                                            <input
                                                type="text"
                                                name="postcode"
                                                id="postcode"
                                                autocomplete="postcode"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm"
                                                v-model="customer.postcode"
                                                :class="[{'border-red-500': errorFor('customer.postcode')}]"
                                            />
                                            <validation-errors :errors="errorFor('customer.postcode')"></validation-errors>
                                        </div>
                                    </div>
                                </div>
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button
                                        type="submit"
                                        class="bg-gray-800 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900"
                                        @click.prevent="book"
                                        :disabled="loading"
                                    >
                                        Book now
                                    </button>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
            <div class="col-start-1 col-end-3 w-full" v-else>
                <div class="rounded-md bg-yellow-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: exclamation -->
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">
                                Attention needed
                            </h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p>
                                    There are no items in the basket!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="md:col-span-1 pl-5">
                <div class="flex justify-between pb-2">
                    <div class="font-semibold" style="color: gray">Your Cart</div>
                    <span v-if="itemsInBasket" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">Items {{ itemsInBasket }}</span>
                    <span v-else class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">Empty</span>
                </div>

                <transition-group name="fade">
                    <div v-for="item in basket" :key="item.bookable.id" class="py-1">
                        <div class="pt-2 pb-1 flex justify-between border-t-2 border-fuchsia-600">
                            <span class="font-semibold">
                              <router-link
                                  :to="{name: 'bookable', params: {id: item.bookable.id}}"
                              >{{ item.bookable.title }}</router-link>
                            </span>
                            <span class="font-semibold">${{ item.price.total }}</span>
                        </div>

                        <div class="py-1 flex justify-between">
                            <span>From {{ item.dates.from }}</span>
                            <span>To {{ item.dates.to }}</span>
                        </div>

                        <div class="py-1 text-right">
                            <button
                                class="btn btn-sm btn-outline-secondary"
                                @click="$store.dispatch('removeFromBasket', item.bookable.id)"
                            >
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </transition-group>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapState } from "vuex";
    import validationErrors from "./../shared/mixins/validationErrors";

    export default {
        mixins: [validationErrors],
        data() {
            return {
                loading: false,
                bookingAttempted: false,
                customer: {
                    first_names: null,
                    last_name: null,
                    email: null,
                    address_line_1: null,
                    address_line_2: null,
                    city: null,
                    county: null,
                    country: null,
                    postcode: null
                }
            };
        },
        computed: {
            ...mapGetters(["itemsInBasket"]),
            ...mapState({
                basket: state => state.basket.items
            }),
            success() {
                return !this.loading && 0 === this.itemsInBasket && this.bookingAttempted;
            }
        },
        methods: {
            async book() {
                this.loading = true;
                this.bookingAttempted = false;
                this.errors = null;

                try {
                    await axios.post(`/api/checkout`, {
                        customer: this.customer,
                        bookings: this.basket.map(basketItem => ({
                            bookable_id: basketItem.bookable.id,
                            from: basketItem.dates.from,
                            to: basketItem.dates.to
                        }))
                    });
                    this.$store.dispatch("clearBasket");
                } catch (error) {
                    this.errors = error.response && error.response.data.errors;
                }

                this.loading = false;
                this.bookingAttempted = true;
            }
        }
    };
</script>
