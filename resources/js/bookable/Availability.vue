<template>
    <div class="sm:pl-3 sm:order-none order-first mb-7 sm:mb-0">
        <div class="mb-3 font-semibold" style="color: gray">Check availability</div>
        <form action="#" method="get">
            <div class="flex mb-4">
                <div class="flex flex-col w-6/12 pr-1.5">
                    <label
                        class="uppercase font-semibold text-xs mb-2"
                        style="color: gray"
                        for="date-from"
                    >from</label>
                    <input
                        class="border rounded pl-2 pt-1 pb-1"
                        id="date-from"
                        type="date"
                        name="date-from"
                        v-model="from"
                        v-on:keyup.enter="check"
                    />
                </div>
                <div class="flex flex-col w-6/12 pl-1.5">
                    <label
                        class="uppercase font-semibold text-xs mb-2"
                        style="color: gray"
                        for="date-to"
                    >to</label>
                    <input
                        class="border rounded pl-2 pt-1 pb-1"
                        id="date-to"
                        type="date"
                        name="date-to"
                        v-model="to"
                        v-on:keyup.enter="check"
                    />
                </div>
            </div>
            <button
                type="submit"
                v-on:click="check"
                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 w-full"
            >
                Check availability
            </button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                from: null,
                to: null,
            }
        },
        methods: {
            check() {
                alert('I will do something now!');
            }
        }

    }
</script>
