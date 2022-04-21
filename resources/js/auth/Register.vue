<template>
    <div class="max-w-7xl mx-auto px-3.5 sm:px-4 lg:px-6 mt-4">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Register for a free account
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600 max-w">
                Or
                <router-link :to="{name: 'login'}" class="font-medium text-indigo-600 hover:text-indigo-500">login here</router-link>.
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form class="space-y-6" action="#" method="POST">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Name
                        </label>
                        <div class="mt-1">
                            <input
                                id="name"
                                name="name"
                                type="text"
                                autocomplete="name"
                                placeholder="Name"
                                required="required"
                                v-model="user.name"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                :class="[{'border-red-500': errorFor('name')}]"
                            >
                            <validation-errors :errors="errorFor('name')"></validation-errors>
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email address
                        </label>
                        <div class="mt-1">
                            <input
                                id="email"
                                name="email"
                                type="email"
                                autocomplete="email"
                                placeholder="Email address"
                                required="required"
                                v-model="user.email"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                :class="[{'border-red-500': errorFor('email')}]"
                            >
                            <validation-errors :errors="errorFor('email')"></validation-errors>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password
                        </label>
                        <div class="mt-1">
                            <input
                                id="password"
                                name="password"
                                type="password"
                                placeholder="Password"
                                required="required"
                                v-model="user.password"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                :class="[{'border-red-500': errorFor('password')}]"
                            >
                            <validation-errors :errors="errorFor('password')"></validation-errors>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Re-type Password
                        </label>
                        <div class="mt-1">
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                placeholder="Confirm your password"
                                required="required"
                                v-model="user.password_confirmation"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                :class="[{'border-red-500': errorFor('password_confirmation')}]"
                            >
                            <validation-errors :errors="errorFor('password_confirmation')"></validation-errors>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="agree_to_terms" name="agree_to_terms" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="agree_to_terms" class="ml-2 block text-sm text-gray-900">
                                I agree to the <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">terms and conditions</a>.
                            </label>
                        </div>
                    </div>

                    <div>
                        <button
                            type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            :disabled="loading"
                            @click.prevent="register"
                        >Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import validationErrors from "../shared/mixins/validationErrors";
    import { logIn } from "../shared/utils/auth";

    export default {
        mixins: [validationErrors],
        data() {
            return {
                user: {
                    name: null,
                    email: null,
                    password: null,
                    password_confirmation: null
                },
                loading: false
            };
        },
        methods: {
            async register() {
                this.loading = true;
                this.errors = null;

                try {
                    const response = await axios.post("/register", this.user);

                    if (201 === response.status) {
                        logIn();
                        this.$store.dispatch("loadUser");
                        this.$router.push({ name: "home" });
                    }
                } catch (error) {
                    this.errors = error.response && error.response.data.errors;
                }

                this.loading = false;
            }
        }
    };
</script>
