<template>
    <div class="ml-3 relative">
        <div>
            <button v-on:click="isOpen=!isOpen" class="relative z-10 bg-white rounded-full flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="user-menu" aria-haspopup="true">
                <span class="sr-only">Open user menu</span>
                <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
            </button>
            <button v-if="isOpen" v-on:click="isOpen=false" tabindex="-1" class="fixed inset-0 h-full w-full cursor-default"></button>
        </div>
        <!--
          Profile dropdown panel, show/hide based on dropdown state.

          Entering: "transition ease-out duration-200"
            From: "transform opacity-0 scale-95"
            To: "transform opacity-100 scale-100"
          Leaving: "transition ease-in duration-75"
            From: "transform opacity-100 scale-100"
            To: "transform opacity-0 scale-95"
        -->
        <div v-if="isOpen" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Your Profile</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Settings</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</a>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isOpen: false
            }
        },
        created() {
            const handleEscape = (e) => {
                if (e.key === 'Esc' || e.key === 'Escape') {
                    this.isOpen = false;
                }
            }

            document.addEventListener('keydown', handleEscape);

            this.$once('hook:beforeDestroy', () => {
                document.removeEventListener('keydown', handleEscape);
            })
        }
    };
</script>
