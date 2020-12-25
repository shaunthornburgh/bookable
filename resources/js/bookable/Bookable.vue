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
                <reviewlist :bookable-id="this.$route.params.id"></reviewlist>
            </div>
            <div class="md:col-span-1">
                <availability :bookable-id="this.$route.params.id"></availability>
            </div>
        </div>
    </div>
    <div v-else>Loading ...</div>
</template>

<script>
    import Availability from "./Availability";
    import Gallery from "./Gallery";
    import Reviewlist from "./ReviewList";

    export default {
        components: {
            Availability,
            Gallery,
            Reviewlist,
        },
        data() {
            return {
                bookable: null,
                loading: false
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
        }
    }
</script>
