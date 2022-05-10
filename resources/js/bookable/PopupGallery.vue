<template>

    <div class="modal opacity-100 fixed w-full h-full top-0 left-0 flex items-center justify-center overflow-x-hidden overflow-y-auto z-40">
      <div class="modal-overlay absolute w-full h-full bg-white opacity-95"></div>

      <div class="modal-container fixed w-full h-full overflow-y-auto mb-4">
        
        <div v-on:click="closePopup" class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-black text-sm z-50">
          <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
          </svg>
          (Esc)
        </div>

        <div class="modal-content container mx-auto h-auto text-left p-4 max-width-6xl ">
        
          <div class="flex justify-between items-center pt-8 pb-2">
            <p class="text-2xl font-bold">{{ title }} photos</p>
          </div>

          <div class="content-center pb-8">
            <img v-for="(image, index) in images" :key="index" v-bind:src="image.path" class="mt-4 min-w-full rounded" alt="">
          </div>

        </div>
      </div>
    </div>

</template>

<script>
    export default {
        props: {
            isOpen: Boolean,
            images: Array,
            title: String
        },
        methods: {
            closePopup(){
                console.log('close')
                this.$emit('close')
            }
        },
        created() {
            console.log('modal created')
            const handleEscape = (e) => {
            if (e.key === "Esc" || e.key === "Escape") {
                this.closePopup();
            }
            };

            document.addEventListener("keydown", handleEscape);

            this.$once("hook:beforeDestroy", () => {
            document.removeEventListener("keydown", handleEscape);
            });
        },
    }
</script>
<style>
  .modal {
  transition: opacity 0.25s ease;
  }
  body.modal-active {
  overflow-x: hidden;
  overflow-y: visible !important;
  }
  .opacity-95 {opacity: .95;}
</style>