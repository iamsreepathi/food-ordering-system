<template>
    <AppLayout :header="false">
        <section class="space-y-4">
            <SectionTitle>Your Shopping Cart</SectionTitle>
            <ShoppingCart v-if="!empty" :items="items" />
            <EmptyCart v-else="empty" />
        </section>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionTitle from "@/Components/SectionTitle.vue";
import EmptyCart from "@/Components/EmptyCart.vue";
import ShoppingCart from "../Components/ShoppingCart.vue";
import { computed } from "vue";

const { items } = defineProps({
    items: Array,
});

const empty = computed(() => {
    return items.length == 0;
});
</script>
