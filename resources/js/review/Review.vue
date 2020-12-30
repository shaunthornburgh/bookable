<template>
    <div>
        <div v-if="error">
            <div v-if="loading">Loading...</div>
            <div v-else>
                <error message="There was an error with the response from the server, please try again"></error>
            </div>
        </div>
        <div v-else>
            <div v-if="alreadyReviewed">
                <div v-if="loading">Loading...</div>
                <div v-else>
                    <warning message="It looks like you have already left a review for this booking."></warning>
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
                                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm rounded-md border rounded pl-2 pt-1 pb-1"
                                                        v-model="review.content"
                                                        :class="[{'border-red-500': this.errorFor('content')}]"
                                                    ></textarea>
                                                    <validation-errors :errors="errorFor('content')"></validation-errors>
                                                </div>
                                                <p class="mt-2 text-sm text-gray-500">Write a few sentences about your stay with [insert host name].</p>
                                            </div>
                                        </dl>
                                    </form>
                                </div>
                                <div class="border-t border-gray-200 px-4 py-5 sm:px-6 text-right">
                                    <button
                                        type="submit"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        @click.prevent="submit"
                                        :disabled="sending"
                                    >Submit review
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
                                    Details of your stay
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
    import { is404, is422 } from "../shared/utils/response";
    import validationErrors from "./../shared/mixins/validationErrors";

    export default {
        mixins: [validationErrors],
        data() {
            return {
                review: {
                    id: null,
                    rating: 5,
                    content: null
                },
                existingReview: null,
                loading: false,
                booking: null,
                error: false,
                sending: false
            };
        },
        async created() {
            this.review.id = this.$route.params.id;
            this.loading = true;
            try {
                this.existingReview = (await axios.get(`/api/reviews/${this.review.id}`)).data.data;
            } catch (err) {
                if (is404(err)) {
                    try {
                        this.booking = (await axios.get(`/api/booking-by-review/${this.review.id}`)).data.data;
                    } catch (err) {
                        this.error = !is404(err);
                    }
                } else {
                    this.error = true;
                }
            }
            this.loading = false;
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
            },
            oneColumn() {
                return !this.loading && this.alreadyReviewed;
            },
            twoColumns() {
                return this.loading || !this.alreadyReviewed;
            }
        },
        methods: {
            submit() {
                this.errors = null;
                this.sending = true;
                axios
                    .post(`/api/reviews`, this.review)
                    .then(response => console.log(response))
                    .catch(err => {
                        if (is422(err)) {
                            const errors = err.response.data.errors;

                            if (errors["content"] && 1 === _.size(errors)) {
                                this.errors = errors;
                                return;
                            }
                        }

                        this.error = true;
                    })
                    .then(() => (this.sending = false));
            }
        }
    };
</script>
