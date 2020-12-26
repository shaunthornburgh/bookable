<template>
    <div>
        <div v-if="loading">Loading...</div>
        <div v-else>
            <div v-if="alreadyReviewed">
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
                                Something's up!
                            </h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p>
                                    It looks like you have already left a review for this booking.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="mt-8 max-w-3xl mx-auto grid grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
                    <div class="space-y-6 lg:col-start-1 lg:col-span-2">
                        <section aria-labelledby="review-title">
                            <div class="bg-white shadow sm:rounded-lg">
                                <div class="px-4 py-5 sm:px-6">
                                    <h2 id="review-title" class="text-lg leading-6 font-medium text-gray-900">
                                        Review
                                    </h2>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                        Add a review for your host
                                    </p>
                                </div>
                                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                                    <form class="space-y-8 divide-y divide-gray-200">
                                        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                            <div class="sm:col-span-6">
                                                <label for="about" class="block text-sm font-medium text-gray-700">
                                                    Stars
                                                </label>
                                                <div class="mt-1">
                                                    <star-rating v-model="review.rating"></star-rating>
                                                </div>
                                                <p class="mt-2 text-sm text-gray-500">How many stars would you give out of 5?</p>
                                            </div>
                                            <div class="sm:col-span-6">
                                                <label for="about" class="block text-sm font-medium text-gray-700">
                                                    Review content
                                                </label>
                                                <div class="mt-1">
                                                    <textarea
                                                        id="about"
                                                        name="about"
                                                        rows="3"
                                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                                        v-model="review.content"
                                                    ></textarea>
                                                </div>
                                                <p class="mt-2 text-sm text-gray-500">Write a few sentences about your stay with [insert host name].</p>
                                            </div>
                                        </dl>
                                    </form>
                                </div>
                                <div class="border-t border-gray-200 px-4 py-5 sm:px-6 text-right">
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Submit review
                                    </button>
                                </div>
                            </div>
                        </section>
                    </div>

                    <section aria-labelledby="bookable-details-title" class="lg:col-start-3 lg:col-span-1">
                        <div class="bg-white shadow sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h2 id="bookable-details-title" class="text-lg leading-6 font-medium text-gray-900">
                                    Your stay
                                </h2>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                    Your review is only in relation to this rental
                                </p>
                            </div>
                            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-1">
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Dates
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            From {{ booking.from }} to {{ booking.to }}
                                        </dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Property
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            <router-link
                                                class="font-medium"
                                                :to="{name: 'bookable', params: { id: booking.bookable.bookable_id}}"
                                            >{{ booking.bookable.title }}</router-link>
                                        </dd>
                                    </div>
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">
                                            Host
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            [INSERT HOST NAME]
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                review: {
                    rating: 5,
                    content: null
                },
                existingReview: null,
                loading: false,
                booking: null
            };
        },
        created() {
            this.loading = true;
            axios
                .get(`/api/reviews/${this.$route.params.id}`)
                .then(response => {
                    this.existingReview = response.data.data
                })
                .catch(err => {
                    if (
                        err.response &&
                        err.response.status &&
                        404 === err.response.status
                    ) {
                        return axios
                            .get(`/api/booking-by-review/${this.$route.params.id}`)
                            .then(response => {
                                this.booking = response.data.data;
                            });
                    }
                })
                .then(() => {
                    this.loading = false
                });
        },
        computed: {
            alreadyReviewed() {
                return this.hasReview || !this.booking;
            },
            hasReview() {
                return this.existingReview !== null;
            },
            hasBooking() {
                return this.booking !== null;
            }
        }
    };
</script>
