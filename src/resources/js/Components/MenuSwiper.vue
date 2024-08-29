<template>
    <Swiper
        :slidesPerView="2"
        :modules="modules"
        :navigation="true"
        :breakpoints="{
            '375': {
                slidesPerView: 2,
            },
            '425': {
                slidesPerView: 3,
            },
            '640': {
                slidesPerView: 4,
            },
            '768': {
                slidesPerView: 5,
            },
            '1024': {
                slidesPerView: 7,
            },
            '1280': {
                slidesPerView: 10,
            },
        }"
    >
        <SwiperSlide v-for="item in items" :key="item.id"
            ><p
                class="font-semibold hover:bg-green-50 hover:cursor-pointer rounded-md mx-4 xl:mr-4 xl:ml-0"
                :class="{ activeCat: item.id === categoryId }"
                @click="() => onButtonClick(item)"
            >
                {{ item.name }}
            </p></SwiperSlide
        >
    </Swiper>
</template>

<script setup>
import "swiper/css";
import "swiper/css/navigation";
import { SwiperSlide, Swiper } from "swiper/vue";
import { Navigation } from "swiper/modules";

const modules = [Navigation];

const event = "updateCategory";

defineProps({
    items: Array,
    categoryId: Number,
});

const emit = defineEmits([event]);

const onButtonClick = (cat) => {
    emit(event, cat);
};
</script>

<style>
.swiper {
    padding: 0px, 15px;
}
.swiper-button-next,
.swiper-button-prev {
    color: rgb(1, 83, 1);
    top: 12px;
}
.swiper-slide {
    text-align: center;
}
.swiper-button-next:after,
.swiper-button-prev:after {
    font-size: 13px;
    font-weight: bolder;
}
.swiper-button-prev {
    left: -9px;
}
.swiper-button-next {
    right: -9px;
}
</style>
