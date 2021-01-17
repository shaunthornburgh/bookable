<template>
    <div class="sm:pl-3 sm:order-none order-first mb-7 sm:mb-3">
        <div class="mt-3 font-semibold" style="color: gray">Price Breakdown</div>

        <div
            v-for="(days, price) in price.breakdown"
            :key="price"
            class="pt-2 border-t-1 border-fuchsia-600 flex justify-between"
        >
            <span style="color: gray">{{ days }} x £{{ price }}</span>
            <span style="color: gray">£{{ days * price }}</span>
        </div>

        <div class="pt-2 font-bold flex justify-between">
            <span style="color: gray">Total</span>
            <span style="color: gray">£{{ price.total }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            price: Object
        }
    };
</script>
