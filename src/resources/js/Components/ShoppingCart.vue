<template>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <ul class="grid grid-cols-1 gap-4 lg:col-span-2">
            <CartItem v-for="item in items" :key="item.item.id" :item="item" />
        </ul>
        <OrderSummary :items="items" />
    </div>
</template>

<script setup>
import CartItem from "@/Components/CartItem.vue";
import OrderSummary from "@/Components/OrderSummary.vue";

const { items } = defineProps({
    items: {
        type: Array,
        default: [],
    },
});
</script>
