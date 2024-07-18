<template>
    <div>
        <div class="border p-4 rounded space-y-2 text-sm">
            <p class="font-semibold">Order Summary</p>
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
            <div class="font-semibold">
                <ButtonLink
                    link="/checkout"
                    class="block text-center rounded-md"
                    >Checkout</ButtonLink
                >
            </div>
        </div>
    </div>
</template>
<script setup>
import { computed } from "vue";
import { TwoDigitDecimal } from "@/Utils/MathUtils";
import ButtonLink from "@/Components/ButtonLink.vue";

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
