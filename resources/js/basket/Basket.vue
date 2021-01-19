<template>
    <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:w-full sm:mb-64 mb-10 flex flex-col">
        <div class="col-start-1 col-end-3 w-full">
            <div class="bg-white shadow sm:rounded-lg mb-7">
                Basket form
            </div>
        </div>
        <div class="md:col-span-1">
            <div class="flex justify-between pb-2">
                <div class="font-semibold" style="color: gray">Your Cart</div>
                <span v-if="itemsInBasket" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">Items {{ itemsInBasket }}</span>
                <span v-else class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">Empty</span>
            </div>

            <transition-group name="fade">
                <div v-for="item in basket" :key="item.bookable.id" class="py-1">
                    <div class="pt-2 pb-1 flex justify-between border-t-2 border-fuchsia-600">
                        <span class="font-semibold">
                          <router-link
                              :to="{name: 'bookable', params: {id: item.bookable.id}}"
                          >{{ item.bookable.title }}</router-link>
                        </span>
                        <span class="font-semibold">${{ item.price.total }}</span>
                    </div>

                    <div class="py-1 flex justify-between">
                        <span>From {{ item.dates.from }}</span>
                        <span>To {{ item.dates.to }}</span>
                    </div>

                    <div class="py-1 text-right">
                        <button
                            class="btn btn-sm btn-outline-secondary"
                            @click="$store.dispatch('removeFromBasket', item.bookable.id)"
                        >
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </transition-group>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapState } from "vuex";

    export default {
        computed: {
            ...mapGetters(["itemsInBasket"]),
            ...mapState({
                basket: state => state.basket.items
            })
        }
    };
</script>
