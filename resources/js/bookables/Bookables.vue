<template>
    <div>
        <div v-if = "loading">
            Data is loading
        </div>
        <div v-else>
            <div class="mt-12 grid gap-5 max-w-lg mx-auto lg:grid-cols-3 lg:max-w-none">
                <bookable-list-item
                    :item-title="bookable.title"
                    :item-description="bookable.description"
                    :price="1000"
                    v-for="(bookable, index) in bookables"
                    :key="index"
                ></bookable-list-item>
            </div>
        </div>
    </div>
</template>

<script>
    import BookableListItem from "./BookableListItem";

    export default {
        components: {
            BookableListItem
        },
        data() {
            return {
                bookables: null,
                loading: false
            }
        },
        created() {
            this.loading = true;

            const request = axios
                .get('/api/bookables')
                .then(response => {
                    this.bookables = response.data;
                    this.loading = false;
                });
        }
    }
</script>
