<template>
  <div class="pl-4 pr-4 sm:pr-8">
    <div class="mb-7 font-semibold" style="color: gray">Reviews</div>
    <div v-if="loading">Loading</div>
    <div v-else>
      <div
        class="mb-8 pb-8"
        style="border-bottom: 1px solid lightgray"
        v-for="(review, index) in visibleReviews"
        :key="index"
      >
        <div class="flex justify-between">
          <div>Piotr Jura</div>
          <star-rating :value="review.rating"></star-rating>
        </div>
        <div class="mb-7 text-sm">{{ review.created_at | fromNow }}</div>
        <p>{{ review.content }}</p>
      </div>
      <button
        v-if="reviews.length > 6"
        v-on:click="showToggle"
        type="button"
        class="
          inline-flex
          items-center
          px-4
          py-2
          border border-gray-300
          shadow-sm
          text-base
          font-medium
          rounded-md
          text-gray-700
          hover:bg-gray-50
          focus:outline-none
          focus:ring-2
          focus:ring-offset-2
          focus:ring-indigo-500
        "
      >
        {{ showAllReviews ? 'Show last reviews' : 'Show all reviews' }}
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    bookableId: [String, Number],
  },
  data() {
    return {
      loading: false,
      reviews: null,
      showAllReviews: false,
    };
  },
  computed: {
    visibleReviews() {
      return this.showAllReviews ? this.reviews : this.reviews.slice(0, 6);
    },
  },
  methods: {
    showToggle() {
      this.showAllReviews = ! this.showAllReviews;
    }
  },
  created() {
    this.loading = true;
    axios
      .get(`/api/bookables/${this.bookableId}/reviews`)
      .then((response) => (this.reviews = response.data.data))
      .then(() => (this.loading = false));
  },
};
</script>
