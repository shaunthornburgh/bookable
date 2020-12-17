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
                        @keyup.enter="check"
                        :class="[{'border-red-500': this.errorFor('from')}]"
                    />
                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1"
                        v-for="(error, index) in this.errorFor('from')"
                        :key="'from' + index"
                    >{{ error }}</span>
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
                        @keyup.enter="check"
                        :class="[{'border-red-500': this.errorFor('to')}]"
                    />
                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1"
                        v-for="(error, index) in this.errorFor('to')"
                        :key="'to' + index"
                        >{{ error }}</span>
                </div>
            </div>
            <button
                type="submit"
                @click="check"
                :disabled="loading"
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
                loading: false,
                status: null,
                errors: null,
            }
        },
        methods: {
            check() {
                this.loading = true;
                this.errors = null;

                axios.get(
                    `/api/bookables/${this.$route.params.id}/availability?from=${this.from}&to=${this.to}`
                ).then(response => {
                    this.status = response.status;
                }).catch(error => {
                    if (422 === error.response.status) {
                        this.errors = error.response.data.errors;
                    }
                    this.status = error.response.status;
                })
                .then(() => (this.loading = false));
            },
            errorFor(field) {
                return this.hasErrors && this.errors[field] ? this.errors[field] : null;
            }
        },
        computed: {
            hasErrors() {
                return 422 === this.status && this.errors !== null;
            },
            hasAvailability() {
                return 200 === this.status;
            },
            noAvailability() {
                return 400 === this.status;
            }
        }
    };
</script>
