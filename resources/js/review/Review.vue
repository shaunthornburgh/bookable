<template>
    <div>
        <div class="mt-8 max-w-3xl mx-auto grid grid-cols-1 gap-6 sm:px-6 lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-3">
            <div class="space-y-6 lg:col-start-1 lg:col-span-2">
                <!-- Description list-->
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
                                            <star-rating :rating="review.rating" v-on:rating:changed="review.rating = $event"></star-rating>
                                        </div>
                                        <p class="mt-2 text-sm text-gray-500">How many stars would you give out of 5?</p>
                                    </div>
                                    <div class="sm:col-span-6">
                                        <label for="about" class="block text-sm font-medium text-gray-700">
                                            Review content
                                        </label>
                                        <div class="mt-1">
                                            <textarea id="about" name="about" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
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
                                    [INSERT BOOKABLE DATES]
                                </dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">
                                    Property
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    [INSERT PROPERTY NAME]
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
</template>

<script>
    export default {
        data() {
            return {
                review: {
                    rating: 5,
                    content: null
                }
            };
        }
        // methods: {
        //   onRatingChanged(rating) {
        //     console.log(rating);
        //   }
        // }
    };
</script>
