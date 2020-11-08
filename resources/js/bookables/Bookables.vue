<template>
    <div>
        <div v-if = "loading">
            Data is loading
        </div>
        <div v-else>
            <div class="mt-12 grid gap-5 max-w-lg mx-auto lg:grid-cols-3 lg:max-w-none">
                <bookable-list-item
                    :item-title="bookable.title"
                    :item-content="bookable.content"
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
            setTimeout(() => {
                this.bookables = [{
                    title: "Cheap Villa",
                    content: "A very cheap villa"
                },
                this.bookables = {
                    title: "Cheap Villa 2",
                    content: "A very cheap villa 2"
                },
                this.bookables = {
                    title: "Cheap Villa 3",
                    content: "A very cheap villa 3"
                },
                this.bookables = {
                    title: "Cheap Villa 4",
                    content: "A very cheap villa 4"
                },
                this.bookables = {
                    title: "Cheap Villa 5",
                    content: "A very cheap villa 5"
                },
                this.bookables = {
                    title: "Cheap Villa 6",
                    content: "A very cheap villa 6"
                },
                this.bookables = {
                    title: "Cheap Villa 7",
                    content: "A very cheap villa 7"
                }];
                this.loading = false;
            }, 2000);
        }
    }
</script>
