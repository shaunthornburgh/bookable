<template>
  <div>
    <div v-show="mobile">
      <div class="flex items-center sm:hidden">
        <img
        v-if="isLoggedIn"
          class="h-10 w-10 object-cover rounded-full border-2 border-gray-600"
          src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=256&q=80"
          alt=""
        />
        <img
        v-else
          class="h-10 w-10 object-cover rounded-full border-2 border-gray-600"
          src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=256&q=80"
          alt=""
        />
        <span class="ml-4 font-semibold text-gray-200 sm:hidden"
        
          >Account Area</span
        >
      </div>
      <div class="mt-5 sm:hidden">
          <router-link
          v-if="!isLoggedIn"
          :to="{ name: 'login' }"
          class="block text-gray-400 hover:text-white"
          role="menuitem"
          >Sign-in</router-link
        >
          <router-link
          v-if="!isLoggedIn"
          :to="{ name: 'register' }"
          class="mt-3 block text-gray-400 hover:text-white"
          role="menuitem"
          >Register</router-link
        >

                <a
          v-if="isLoggedIn"
          href="#"
          class="block text-gray-400 hover:text-white"
          role="menuitem"
          >Profile</a
        >
        <a
          v-if="isLoggedIn"
          href="#"
          class="mt-3 block text-gray-400 hover:text-white"
          role="menuitem"
          >Settings</a
        >
        <a
          v-if="isLoggedIn"
          href="#"
          class="mt-3 block text-gray-400 hover:text-white"
          role="menuitem"
          >Bookings</a
        >
        <a
          v-if="isLoggedIn"
          href="#"
          class="mt-3 block text-gray-400 hover:text-white"
          role="menuitem"
          @click.prevent="logout"
          >Sign out</a
        >
      </div>
    </div>
    <div v-show="!mobile" class="ml-3 relative">
      <div>
        <button
          v-if="!isLoggedIn"
          v-on:click="isOpen = !isOpen"
          class="
            relative
            z-10
            bg-white
            rounded-full
            flex
            text-sm
            focus:outline-none
            focus:ring-2
            focus:ring-offset-2
            focus:ring-indigo-500
          "
          id="user-menu"
          aria-haspopup="true"
        >
          <span
            class="
              inline-block
              h-8
              w-8
              rounded-full
              overflow-hidden
              bg-gray-100
            "
          >
            <svg
              class="h-full w-full text-gray-300"
              fill="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z"
              />
            </svg>
          </span>
        </button>
        <button
          v-if="isLoggedIn"
          v-on:click="isOpen = !isOpen"
          class="
            relative
            z-10
            bg-white
            rounded-full
            flex
            text-sm
            focus:outline-none
            focus:ring-2
            focus:ring-offset-2
            focus:ring-indigo-500
          "
          id="user-menu"
          aria-haspopup="true"
        >
          <span class="sr-only">Open user menu</span>
          <img
            class="h-8 w-8 rounded-full"
            src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            alt=""
          />
        </button>
        <button
          v-if="isOpen"
          v-on:click="isOpen = false"
          tabindex="-1"
          class="fixed inset-0 h-full w-full cursor-default"
        ></button>
      </div>
      <div
        v-if="isOpen"
        class="
          origin-top-right
          absolute
          right-0
          mt-2
          w-48
          rounded-md
          shadow-lg
          py-1
          bg-white
          ring-1 ring-black ring-opacity-5
        "
        role="menu"
        aria-orientation="vertical"
        aria-labelledby="user-menu"
      >
        <router-link
          v-if="!isLoggedIn"
          :to="{ name: 'login' }"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
          role="menuitem"
          >Sign-in</router-link
        >
        <router-link
          v-if="!isLoggedIn"
          :to="{ name: 'register' }"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
          role="menuitem"
          >Register</router-link
        >
        <a
          v-if="isLoggedIn"
          href="#"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
          role="menuitem"
          >Profile</a
        >
        <a
          v-if="isLoggedIn"
          href="#"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
          role="menuitem"
          >Settings</a
        >
        <a
          v-if="isLoggedIn"
          href="#"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
          role="menuitem"
          >Bookings</a
        >
        <a
          v-if="isLoggedIn"
          href="#"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
          role="menuitem"
          @click.prevent="logout"
          >Sign out</a
        >
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";

export default {
  props: {
    mobile: Boolean,
  },
  data() {
    return {
      isOpen: false,
    };
  },
  computed: {
    ...mapState({
      isLoggedIn: "isLoggedIn",
    }),
  },
  created() {
    const handleEscape = (e) => {
      if (e.key === "Esc" || e.key === "Escape") {
        this.isOpen = false;
      }
    };

    document.addEventListener("keydown", handleEscape);

    this.$once("hook:beforeDestroy", () => {
      document.removeEventListener("keydown", handleEscape);
    });
  },
  methods: {
    async logout() {
      try {
        axios.post("/logout");
        this.$store.dispatch("logout");
      } catch (error) {
        this.$store.dispatch("logout");
      }
    },
  },
};
</script>
