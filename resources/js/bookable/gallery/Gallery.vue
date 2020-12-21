<template>
    <div>
        <div v-if="loading">Loading</div>
        <div v-else class="grid grid-cols-3 grid-rows-2 gap-2 mb-7 w-full relative" style="max-height: 500px">
            <gallery-item
                v-bind="image"
                v-for="(image, index) in images"
                :key="index"
                v-if="index <= 3"
            ></gallery-item>
            <router-link
                :to="{ name: 'media', params: { bookableId } }"
                class="absolute right-5 bottom-5 inline-flex items-center justify-center pl-5 py-2 border border-solid text-sm font-semibold rounded-lg shadow-sm text-black focus:outline-none w-40 h-9"
            >Show all photos
            </router-link>
        </div>
    </div>
</template>

<script>
    import GalleryItem from "./GalleryItem";

    export default {
        props: {
            bookableId: String,
        },
        components: {
            GalleryItem
        },
        data() {
            return {
                loading: false,
                images: null
            }
        },
        created() {
            this.loading = true;
            axios
                .get(`/api/bookables/${this.bookableId}/images`)
                .then(response => this.images = response.data.data)
                .then(() => this.loading = false);
        }
    }
</script>

<style scoped>
    a {
        background: url('/images/dots.svg') 16px center no-repeat;
        background-size: 13px;
        background-color: #fff;
        border-color: #222;
    }
</style>
