<template>
    <Head>
        <title>Menu Item {{ item.name }} | Spice Savor</title>
    </Head>
    <AppLayout>
        <ItemDetail :item="item" />
        <hr />
        <section id="ratings" class="space-y-4">
            <SectionTitle>Customer Ratings</SectionTitle>
            <ul class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <RatingCard
                    v-for="rating in ratings.data"
                    :key="rating.id"
                    :rating="rating"
                    :maxRating="maxRating"
                />
            </ul>
            <CursorNavigation
                :next="ratings.links.next"
                :prev="ratings.links.prev"
            />
        </section>
    </AppLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionTitle from "@/Components/SectionTitle.vue";
import ItemDetail from "@/Components/ItemDetail.vue";
import RatingCard from "../Components/RatingCard.vue";
import CursorNavigation from "../Components/CursorNavigation.vue";

defineProps({
    item: Object,
    ratings: Object,
    maxRating: Number,
});
</script>
