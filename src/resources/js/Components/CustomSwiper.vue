<template>
    <Swiper
        :slidesPerView="1"
        :spaceBetween="15"
        :modules="modules"
        :pagination="{
            clickable: true,
        }"
        :autoplay="{
            delay: 2500,
            disableOnInteraction: false,
        }"
        :breakpoints="{
            '640': {
                slidesPerView: 2,
            },
            '768': {
                slidesPerView: 3,
            },
            '1024': {
                slidesPerView: 3,
            },
            '1280': {
                slidesPerView: 4,
            },
        }"
    >
        <slot></slot>
    </Swiper>
</template>

<script setup>
import "swiper/css";
import "swiper/css/pagination";
import { Swiper } from "swiper/vue";
import { Pagination, Autoplay } from "swiper/modules";

const modules = [Pagination, Autoplay];
</script>

<style scoped>
.swiper-pagination {
    bottom: 80px;
}
.swiper-pagination-bullet {
    background-color: gray;
}
.swiper-pagination-bullet-active {
    color: green;
}
.swiper {
    padding-bottom: 40px;
}
</style>
