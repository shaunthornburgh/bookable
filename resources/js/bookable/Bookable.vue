<template>
    <div v-if="!loading">
        <gallery :bookable-id="this.$route.params.id"></gallery>
        <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:w-full sm:mb-64 mb-10 flex flex-col">
            <div class="col-start-1 col-end-3 w-full">
                <div class="mb-8">
                    <div class="p-4 border rounded shadow-sm">
                        <div class="pb-5" style="border-bottom: 1px solid lightgray">
                            <h1 class="text-3xl font-semibold">{{ bookable.title }}</h1>
                        </div>
                        <div class="pt-5">
                            <p>{{ bookable.description }}</p>
                        </div>
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
    import Gallery from "./gallery/Gallery";
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
