<template>
    <Head>
        <title>South Indian Cuisine | Spice Savor</title>
    </Head>
    <AppLayout :subscription="true">
        <section class="space-y-2 text-center">
            <SectionTitle>Testimonials</SectionTitle>
            <p class="font-semibold">
                We serve wide group of customers. Listen what our customers has
                to say about us.
            </p>
            <div>
                <CustomSwiper>
                    <SwiperSlide> <TheTestimonial /></SwiperSlide>
                    <SwiperSlide> <TheTestimonial /></SwiperSlide>
                    <SwiperSlide> <TheTestimonial /></SwiperSlide>
                    <SwiperSlide> <TheTestimonial /></SwiperSlide>
                    <SwiperSlide> <TheTestimonial /></SwiperSlide>
                </CustomSwiper>
            </div>
        </section>
        <hr />
        <section id="featured" class="space-y-4 pb-4">
            <SectionTitle class="text-center">Featured Items</SectionTitle>
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4"
            >
                <menu-item v-for="item in items" :item="item" :key="item.id" />
                <div class="flex items-center justify-center">
                    <a
                        class="border rounded-full px-4 py-2 font-semibold hover:underline"
                        href="/menu"
                        >View Our Menu &rarr;</a
                    >
                </div>
            </div>
        </section>
        <hr />
        <section class="space-y-4 pb-4">
            <SectionTitle class="text-center">Our Stores Location</SectionTitle>
            <div class="grid grid-cols-3 text-sm text-gray-400">
                <TheCard v-for="location in locations" :key="location.id">
                    <h2 class="font-semibold text-green-900">
                        {{ location.name }}
                    </h2>
                    <p>{{ location.address.line }}</p>
                    <p>
                        {{ location.address.city }},
                        {{ location.address.state }}
                    </p>
                    <p>
                        {{ location.address.country }},
                        {{ location.address.zipCode }}
                    </p>
                </TheCard>
            </div>
        </section>
    </AppLayout>
</template>
<script setup>
import { Head } from "@inertiajs/vue3";
import { SwiperSlide } from "swiper/vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import MenuItem from "@/Components/MenuItem.vue";
import SectionTitle from "@/Components/SectionTitle.vue";
import TheTestimonial from "@/Components/TheTestimonial.vue";
import CustomSwiper from "@/Components/CustomSwiper.vue";
import TheCard from "@/Components/TheCard.vue";

defineProps({
    items: Array,
    locations: Array,
});
</script>
