<template>
    <div v-if="loading">Loading</div>
    <div v-else>
        <div class="mb-5">
            <i class="fas fa-backspace"></i> <router-link :to="{ name: 'bookable', params: { bookableId } }">Back</router-link>
        </div>
        <div class="mb-10" v-for="(image, index) in images" :key="index">
            <img class="object-cover" :src="image.path" alt="">
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
                images: null
            }
        },
        created() {
            this.loading = true;
            axios
                .get(`/api/bookables/${this.$route.params.id}/images`)
                .then(response => this.images = response.data.data)
                .then(() => this.loading = false);
        }
    }
</script>
