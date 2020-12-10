<template>
    <div class="grid grid-cols-3 grid-rows-2 gap-2 mb-7 w-full relative" style="max-height: 500px">
        <div class="col-start-1 col-end-4 sm:col-end-3 row-start-1 row-end-3 rounded overflow-hidden cursor-pointer">
            <img class="object-cover" :src="'/images/photo-1.jpeg'" alt="">
        </div>
        <div class="hidden sm:block sm:rounded sm:overflow-hidden sm:cursor-pointer">
            <img class="object-cover" :src="'/images/photo-2.jpeg'" alt="">
        </div>
        <div class="hidden sm:block sm:rounded sm:overflow-hidden sm:cursor-pointer">
            <img class="object-cover" :src="'/images/photo-3.jpeg'" alt="">
        </div>
        <a href="slider.html" class="absolute right-5 bottom-5 inline-flex items-center justify-center pl-5 py-2 border border-solid text-sm font-semibold rounded-lg shadow-sm text-black focus:outline-none w-40 h-9">
            Show all photos
        </a>
    </div>
</template>

<style scoped>
    a {
        background: url('/images/dots.svg') 16px center no-repeat;
        background-size: 13px;
        background-color: #fff;
        border-color: #222;
    }
</style>
