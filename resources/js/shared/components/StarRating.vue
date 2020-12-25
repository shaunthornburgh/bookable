<template>
    <div class="flex">
        <div class="w-6 text-2xl" v-for="star in fullStars" :key="'full' + star">
            <i class="fas fa-star" @click="$emit('input', star)"></i>
        </div>
        <div class="w-6 text-2xl" v-if="halfStar">
            <i class="fas fa-star-half-alt"></i>
        </div>
        <div class="w-6 text-2xl" v-for="star in emptyStars" :key="'empty' + star">
            <i class="far fa-star" @click="$emit('input', fullStars + star)"></i>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            value: Number
        },
        computed: {
            halfStar() {
                const fraction = Math.round(
                    (this.value - Math.floor(this.value)) * 100
                );

                return fraction > 0 && fraction < 50;
            },
            fullStars() {
                return Math.round(this.value);
            },
            emptyStars() {
                return 5 - Math.ceil(this.value);
            }
        }
    };
</script>
