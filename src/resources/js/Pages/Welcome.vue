<template>
    <Head>
        <title>South Indian Cuisine | Food Mania</title>
    </Head>
    <AppLayout>
        <section class="space-y-4 text-center">
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
        <section id="featured" class="space-y-4">
            <SectionTitle>Featured Items</SectionTitle>
            <div
                class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4"
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
        <section id="post" class="bg-green-50 p-2 md:p-10 rounded">
            <div class="space-y-4 text-center">
                <div>
                    <h1 class="text-3xl font-semibold tracking-wider">
                        Subscribe to Our Deals!
                    </h1>
                    <p class="text-gray-400 text-sm">
                        By subscribing you agree to our terms and conditions to
                        get curated list of deals to you inbox.
                    </p>
                </div>
                <form
                    @submit.prevent="
                        form.post('/newsletter/subscription', {
                            preserveScroll: true,
                            preserveState: false,
                        })
                    "
                    class="md:space-x-2 space-y-4 md:space-y-0 md:flex items-start justify-center text-sm"
                >
                    <div class="space-y-2">
                        <input
                            class="px-4 py-2 rounded-full outline-none w-full md:w-64"
                            placeholder="johndoe@example.com"
                            type="email"
                            name="email"
                            id="subscription"
                            v-model="form.email"
                        />
                        <FormError
                            class="text-left px-4"
                            v-if="form.errors.email"
                            :message="form.errors.email"
                        />
                    </div>
                    <div>
                        <ButtonSubmit
                            type="submit"
                            :disabled="form.processing"
                            class="rounded-full py-1.5 w-full"
                            >Subscribe</ButtonSubmit
                        >
                    </div>
                </form>
            </div>
        </section>
    </AppLayout>
</template>
<script setup>
import { Head } from "@inertiajs/vue3";
import { SwiperSlide } from "swiper/vue";
import { useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import MenuItem from "@/Components/MenuItem.vue";
import SectionTitle from "@/Components/SectionTitle.vue";
import TheTestimonial from "@/Components/TheTestimonial.vue";
import CustomSwiper from "@/Components/CustomSwiper.vue";
import FormError from "@/Components/FormError.vue";
import ButtonSubmit from "@/Components/ButtonSubmit.vue";

defineProps({
    items: Array,
});

const form = useForm({
    email: null,
});
</script>
