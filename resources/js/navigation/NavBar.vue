<template>
  <header
    class="
      bg-gray-900
      sm:flex sm:items-center sm:justify-between
      xl:bg-white xl:flex-shrink-0
    "
  >
    <div
      class="
        flex
        justify-between
        px-4
        py-3
        xl:w-72 xl:bg-gray-900 xl:justify-center xl:py-5
      "
    >
      <div>
        <router-link class="btn nav-button" :to="{ name: 'home' }">
          <img
            class="block lg:block h-8 w-auto"
            src="/images/bookable-logo.svg"
            alt="Workflow"
          />
        </router-link>
      </div>
      <div class="flex sm:hidden">
        <button
          @click="toggle"
          type="button"
          class="
            px-2
            text-gray-500
            hover:text-white
            focus:outline-none focus:text-white
          "
        >
          <svg
            class="h-6 w-6 fill-current"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
          >
            <path
              v-if="isOpen"
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"
            />
            <path
              v-if="!isOpen"
              fill-rule="evenodd"
              d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"
            />
          </svg>
        </button>
      </div>
    </div>
    <nav
      class="sm:flex sm:items-center sm:px-4 xl:flex-1 xl:justify-between"
      :class="{ hidden: !isOpen, block: isOpen }"
    >
      <div class="hidden xl:block xl:relative xl:max-w-xs xl:w-full">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
          <svg
            class="h-6 w-6 fill-current text-gray-600"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M16.32 14.9l1.1 1.1c.4-.02.83.13 1.14.44l3 3a1.5 1.5 0 0 1-2.12 2.12l-3-3a1.5 1.5 0 0 1-.44-1.14l-1.1-1.1a8 8 0 1 1 1.41-1.41l.01-.01zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"
            />
          </svg>
        </div>
        <input
          :value="searchString" @input="updateSearchString" v-on:keyup.enter="updateSearch" 
          class="
            block
            w-full
            border border-transparent
            bg-gray-200
            focus:outline-none focus:bg-white focus:border-gray-300
            text-gray-900
            rounded-lg
            pl-10
            pr-4
            py-2
          "
          placeholder="Search by keywords"
        />
      </div>
      <div class="sm:flex sm:items-center">
        <div
          class="
            px-2
            pt-2
            pb-5
            border-b border-gray-800
            sm:flex sm:border-b-0 sm:py-0 sm:px-0
          "
        >
          <router-link class="btn nav-button" :to="{ name: 'basket' }">
            <button
              aria-label="Notifications"
              class="
                p-1
                border-2 border-transparent
                text-gray-400
                rounded-full
                hover:text-gray-500
                focus:outline-none focus:text-gray-500 focus:bg-gray-100
                transition
                duration-150
                ease-in-out
                relative
                overflow-visible
              "
            >
              <span class="sr-only">View basket</span>
              <i class="fas fa-shopping-basket"></i>
              <span
                v-if="itemsInBasket"
                class="
                  inline-flex
                  items-center
                  px-2.5
                  py-0.5
                  rounded-full
                  text-xs
                  font-medium
                  bg-indigo-100
                  text-indigo-800
                "
                >{{ itemsInBasket }}</span
              >
            </button>
          </router-link>

          <account-dropdown></account-dropdown>
        </div>
        <div class="relative px-5 py-5 sm:py-0 sm:ml-4 sm:px-0">
          <div class="flex items-center sm:hidden">
            <img
              class="
                h-10
                w-10
                object-cover
                rounded-full
                border-2 border-gray-600
              "
              src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=256&q=80"
              alt=""
            />
            <span class="ml-4 font-semibold text-gray-200 sm:hidden"
              >Isla Schoger</span
            >
          </div>
          <div class="mt-5 sm:hidden">
            <a href="#account" class="block text-gray-400 hover:text-white"
              >Account settings</a
            >
            <a href="#support" class="mt-3 block text-gray-400 hover:text-white"
              >Support</a
            >
            <a
              href="#sign-out"
              class="mt-3 block text-gray-400 hover:text-white"
              >Sign out</a
            >
          </div>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
import AccountDropdown from "./AccountDropdown";
import { mapState, mapGetters } from "vuex";

export default {
  components: {
    AccountDropdown,
  },
  computed: {
    ...mapGetters({
      itemsInBasket: "itemsInBasket",
    }),
    ...mapState(["searchString"]),
  },
  data() {
    return {
      isOpen: false,
    };
  },
  methods: {
    toggle() {
      this.isOpen = !this.isOpen;
    },
    updateSearchString(e){
      this.$store.dispatch('setSearchString', e.target.value)
    },
    updateSearch(){
      this.$emit('update-search')
    }
  },
};
</script>

