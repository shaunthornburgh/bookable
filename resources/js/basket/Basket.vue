<template>
    <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:w-full sm:mb-64 mb-10 flex flex-col">
        <div class="col-start-1 col-end-3 w-full">
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
                                        <label for="first_name" class="block text-sm font-medium text-gray-700">First name</label>
                                        <input type="text" name="first_name" id="first_name" autocomplete="cc-given-name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm">
                                    </div>

                                    <div class="col-span-4 sm:col-span-2">
                                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last name</label>
                                        <input type="text" name="last_name" id="last_name" autocomplete="cc-family-name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm">
                                    </div>

                                    <div class="col-span-8 sm:col-span-4">
                                        <label for="email_address" class="block text-sm font-medium text-gray-700">Email address</label>
                                        <input type="text" name="email_address" id="email_address" autocomplete="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm">
                                    </div>

                                    <div class="col-span-8 sm:col-span-4">
                                        <label for="email_address" class="block text-sm font-medium text-gray-700">Address line 1</label>
                                        <input type="text" name="address_line_1" id="address_line_1" autocomplete="address_line_1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm">
                                    </div>

                                    <div class="col-span-8 sm:col-span-4">
                                        <label for="email_address" class="block text-sm font-medium text-gray-700">Address line 2</label>
                                        <input type="text" name="address_line_2" id="address_line_2" autocomplete="address_line_2" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm">
                                    </div>

                                    <div class="col-span-4 sm:col-span-2">
                                        <label for="first_name" class="block text-sm font-medium text-gray-700">City</label>
                                        <input type="text" name="city" id="city" autocomplete="cc-city" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm">
                                    </div>

                                    <div class="col-span-4 sm:col-span-2">
                                        <label for="last_name" class="block text-sm font-medium text-gray-700">State</label>
                                        <input type="text" name="state" id="state" autocomplete="cc-state" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm">
                                    </div>

                                    <div class="col-span-4 sm:col-span-2">
                                        <label for="country" class="block text-sm font-medium text-gray-700">Country / Region</label>
                                        <select id="country" name="country" autocomplete="country" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm">
                                            <option>United States</option>
                                            <option>Canada</option>
                                            <option>Mexico</option>
                                        </select>
                                    </div>

                                    <div class="col-span-4 sm:col-span-2">
                                        <label for="postal_code" class="block text-sm font-medium text-gray-700">ZIP / Postal code</label>
                                        <input type="text" name="postal_code" id="postal_code" autocomplete="postal-code" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="bg-gray-800 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900">
                                    Book now
                                </button>
                            </div>
                        </div>
                    </form>
                </section>
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
</template>

<script>
    import { mapGetters, mapState } from "vuex";

    export default {
        computed: {
            ...mapGetters(["itemsInBasket"]),
            ...mapState({
                basket: state => state.basket.items
            })
        }
    };
</script>
