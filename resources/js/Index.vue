<template>
  <div
    class="min-h-screen bg-gray-200 antialiased xl:flex xl:flex-col xl:h-screen"
  >
    <nav-bar @update-search="updateSearch"></nav-bar>
    <div class="xl:flex-1 xl:flex xl:overflow-y-hidden">
      <SearchFilters @update-search="updateSearch" />
      <router-view @change-page="updatePage"></router-view>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
import NavBar from "./navigation/NavBar";
import SearchFilters from "./navigation/SearchFilters";

export default {
  components: {
    NavBar,
    SearchFilters,
  },
  data() {
    return {
      lastSearch: this.$store.state.lastSearch,
    };
  },
  computed: {
    ...mapState({
      lastSearchComputed: "lastSearch",
      availableFilters: "availableFilters",
      selectedFilters: "selectedFilters",
      searchString: "searchString",
      page: "page",
    }),
  },
  methods: {
    updateSearch() {
      this.$store.dispatch("goToPage", 1);
      if (this.$route.name != "home") {
        this.$router.push({ name: "home" });
      }
      this.updateBookables();
    },
    updatePage() {
      this.updateBookables();
    },
    updateBookables() {
      const refreshRequest = axios
        .get("/api/bookables", {
          params: {
            search: this.searchString,
            bedrooms: this.selectedFilters.bedrooms,
            bathrooms: this.selectedFilters.bathrooms,
            priceRange: this.selectedFilters.priceRanges,
            propertyType: this.selectedFilters.propertyTypes,
            amenities: this.selectedFilters.amenities.join(),
            page: this.page,
          },
        })
        .then((response) => {
          this.$store.dispatch("setBookables", response.data.data);
          this.$store.dispatch("setPagination", response.data.meta);
          this.loading = false;
        });
    },
    loadFilters() {
      const filtersRequest = axios.get("/api/filters").then((response) => {
        this.$store.dispatch("setAvailableFilters", response.data);
      });
    },
  },
  mounted() {
    this.updateSearch();
    this.loadFilters();
  },
};
</script>

