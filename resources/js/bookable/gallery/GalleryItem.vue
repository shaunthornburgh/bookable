<template>
    <div class="col-start-1 col-end-4 sm:col-end-3 row-start-1 row-end-3 rounded overflow-hidden cursor-pointer">
        <img class="object-cover" :src="'/images/bookable/1.jpeg'" alt="">
    </div>
</template>

<script>
    export default {
        props: {
            path: String,
        }
    }
</script>
