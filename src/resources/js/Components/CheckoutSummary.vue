<template>
    <div>
        <div class="space-y-2 border rounded p-4 text-sm">
            <p class="font-semibold text-lg">Order Summary</p>
            <ul class="divide-y">
                <CartItem
                    v-for="item in items"
                    :key="item.item.id"
                    :item="item"
                    :long="false"
                />
            </ul>
            <p class="flex justify-between">
                <span>Total Items</span>
                <span>{{ totalItems }}</span>
            </p>
            <p class="flex justify-between">
                <span>Sub Total</span>
                <span>{{ $filters.currencyUSD(subTotal) }}</span>
            </p>
            <p class="flex justify-between">
                <span>Tax</span>
                <span>{{ $filters.currencyUSD(tax) }}</span>
            </p>
            <p class="flex justify-between font-semibold">
                <span>Total</span>
                <span>{{ $filters.currencyUSD(total) }}</span>
            </p>
        </div>
    </div>
</template>

<script setup>
import CartItem from "@/Components/CartItem.vue";
import { TwoDigitDecimal } from "@/Utils/MathUtils";
import { computed } from "vue";

const { items } = defineProps({
    items: {
        type: Array,
        default: [],
    },
});

const totalItems = computed(() => {
    return items?.reduce((prev, curr) => {
        return prev + curr.quantity;
    }, 0);
});

const subTotal = computed(() => {
    const num = items.reduce((prev, curr) => {
        return prev + curr.quantity * curr.item.price;
    }, 0);
    return TwoDigitDecimal(num);
});

const tax = computed(() => {
    return TwoDigitDecimal(subTotal.value * 0.06);
});

const total = computed(() => {
    return TwoDigitDecimal(subTotal.value + tax.value);
});
</script>
