<template>
  <div
    class="
      bg-white
      px-4
      py-3
      flex
      items-center
      justify-between
      border-t border-gray-200
      sm:px-6
    "
  >
    <div class="flex-1 flex justify-between sm:hidden">
      <button
        @click="previous()"
        role="button"
        :disabled="isFirstPage"
        class="
          relative
          inline-flex
          items-center
          px-4
          py-2
          border border-gray-300
          text-sm
          font-medium
          rounded-md
          text-gray-700
          bg-white
          hover:bg-gray-50
          disabled:text-gray-300
          disabled:border-gray-100
          disabled:hover:bg-white
        "
      >
        Previous
      </button>
      <button
        @click="next()"
        role="button"
        :disabled="isLastPage"
        class="
          ml-3
          relative
          inline-flex
          items-center
          px-4
          py-2
          border border-gray-300
          text-sm
          font-medium
          rounded-md
          text-gray-700
          bg-white
          hover:bg-gray-50
          disabled:text-gray-300
          disabled:border-gray-100
          disabled:hover:bg-white
        "
      >
        Next
      </button>
    </div>
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Showing
          <span class="font-medium">{{ pagination.from }}</span>
          to
          <span class="font-medium">{{ pagination.to }}</span>
          of
          <span class="font-medium">{{ pagination.total }}</span>
          results
        </p>
      </div>
      <div v-if="hasPages">
        <nav
          class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
          aria-label="Pagination"
        >
          <button
            @click="previous()"
            role="button"
            class="
              relative
              inline-flex
              items-center
              px-2
              py-2
              rounded-l-md
              border border-gray-300
              bg-white
              text-sm
              font-medium
              text-gray-500
              hover:bg-gray-50
              disabled:text-gray-200
              disabled:border-gray-100
              disabled:hover:bg-white
            "
            :disabled="isFirstPage"
          >
            <span class="sr-only">Previous</span>
            <!-- Heroicon name: solid/chevron-left -->
            <svg
              class="h-5 w-5"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
              aria-hidden="true"
            >
              <path
                fill-rule="evenodd"
                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                clip-rule="evenodd"
              />
            </svg>
          </button>
          <button
            v-for="(page, index) in pagesIndexArray"
            :key="index"
            @click="goToPage(page)"
            role="button"
            v-bind:class="[
              isCurrentPage(page)
                ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                : '',
            ]"
            class="
              bg-white
              border-gray-300
              text-gray-500
              hover:bg-gray-50
              relative
              inline-flex
              items-center
              px-4
              py-2
              border
              text-sm
              font-medium
            "
          >
            {{ page }}
          </button>
          <!-- <span
            class="
              relative
              inline-flex
              items-center
              px-4
              py-2
              border border-gray-300
              bg-white
              text-sm
              font-medium
              text-gray-700
            "
          >
            ...
          </span> -->
          <button
            @click="next()"
            role="button"
            class="
              relative
              inline-flex
              items-center
              px-2
              py-2
              rounded-r-md
              border border-gray-300
              bg-white
              text-sm
              font-medium
              text-gray-500
              hover:bg-gray-50
              disabled:text-gray-200
              disabled:border-gray-100
              disabled:hover:bg-white
            "
            :disabled="isLastPage"
          >
            <span class="sr-only">Next</span>
            <!-- Heroicon name: solid/chevron-right -->
            <svg
              class="h-5 w-5"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
              aria-hidden="true"
            >
              <path
                fill-rule="evenodd"
                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                clip-rule="evenodd"
              />
            </svg>
          </button>
        </nav>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";

export default {
  computed: {
    ...mapState(["pagination", "page"]),
    isFirstPage() {
      return this.pagination.current_page === 1;
    },
    isLastPage() {
      return this.pagination.current_page === this.pagination.last_page;
    },
    hasPages() {
      return this.pagination.last_page > 1;
    },
    pagesIndexArray() {
      return Array.from({ length: this.pagination.last_page }, (_, i) => i + 1);
    },
  },
  methods: {
    next() {
      this.goToPage(this.page + 1);
    },
    previous() {
      this.goToPage(this.page - 1);
    },
    goToPage(page) {
      document
        .getElementById("bookablesContainerStart")
        .scrollIntoView({ behavior: "smooth" });
      this.$store.dispatch("goToPage", page);
      this.$emit("change-page");
    },
    isCurrentPage(page) {
      return page === this.pagination.current_page;
    },
  },
};
</script>
