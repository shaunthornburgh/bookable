<template>
    <div class="max-w-7xl mx-auto px-3.5 sm:px-4 lg:px-6 mt-4">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Sign in to your account
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600 max-w">
                Or
                <router-link :to="{name: 'register'}" class="font-medium text-indigo-600 hover:text-indigo-500">register here</router-link>.
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form class="space-y-6" action="#" method="POST">
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
                                v-model="email"
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
                                autocomplete="current-password"
                                placeholder="Password"
                                required="required"
                                v-model="password"
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                :class="[{'border-red-500': errorFor('password')}]"
                            >
                            <validation-errors :errors="errorFor('password')"></validation-errors>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember_me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                                Remember me
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                Forgot your password?
                            </a>
                        </div>
                    </div>

                    <div>
                        <button
                            type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            :disabled="loading"
                            @click.prevent="login"
                        >Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import validationErrors from "./../shared/mixins/validationErrors";
    import { logIn } from "./../shared/utils/auth";

    export default {
        mixins: [validationErrors],
            data() {
            return {
                email: null,
                password: null,
                loading: false
            };
        },
        methods: {
            async login() {
                this.loading = true;
                this.errors = null;

                try {
                    await axios.get("/sanctum/csrf-cookie");
                    await axios.post("/login", {
                        email: this.email,
                        password: this.password
                    });
                    logIn();
                    this.$store.dispatch("loadUser");
                    this.$router.push({ name: "home" });
                } catch (error) {
                    this.errors = error.response && error.response.data.errors;
                }

                this.loading = false;
            }
        }
    };
</script>
