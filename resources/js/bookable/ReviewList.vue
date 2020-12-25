<template>
    <div class="pl-4 pr-4 sm:pr-8">
        <div class="mb-7 font-semibold" style="color: gray;">Reviews</div>
        <div v-if="loading">Loading</div>
        <div v-else>
            <div class="mb-8 pb-8" style="border-bottom: 1px solid lightgray;" v-for="(review, index) in reviews" :key="index">
                <div class="flex justify-between">
                    <div>Piotr Jura</div>
                    <star-rating :value="review.rating"></star-rating>
                </div>
                <div class="mb-7 text-sm">{{ review.created_at | fromNow }}</div>
                <p>{{ review.content }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            bookableId: String,
        },
        data() {
            return {
                loading: false,
                reviews: null
            }
        },
        created() {
            this.loading = true;
            axios
                .get(`/api/bookables/${this.bookableId}/reviews`)
                .then(response => this.reviews = response.data.data)
                .then(() => this.loading = false);
        }
    }
</script>
