<template>
    <div class="mt-12 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div v-if="!loading" class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            {{ bookable.title }}
                        </h3>
                    </div>
                    <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
                        <p>{{ bookable.description }}</p>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Book
                        </button>
                    </div>
                </div>
            </div>
            <div v-else>Loading ...</div>
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Notifications</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Decide which communications you'd like to receive and how.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
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
                    this.bookable = response.data;
                    this.loading = false;
                });
        }
    }
</script>
