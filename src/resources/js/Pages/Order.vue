<template>
    <Head>
        <title>Order Summary | Food Mania</title>
    </Head>
    <AppLayout>
        <section class="space-y-4">
            <SectionTitle>Items Purchased</SectionTitle>
            <ul class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                <OrderItem
                    v-for="item in order.items"
                    :key="item.id"
                    :item="item"
                />
            </ul>
            <div class="p-4 border rounded shadow-sm border-gray-100 space-y-4">
                <SectionTitle>Order Summary</SectionTitle>
                <ul class="space-y-2 text-sm">
                    <li class="flex justify-between">
                        <span class="font-semibold text-green-800"
                            >Total Items</span
                        >
                        <span class="text-gray-500">{{ totalItems }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="font-semibold text-green-800"
                            >Amount Paid</span
                        >
                        <span class="text-gray-500">{{
                            $filters.currencyUSD(order.total_amount)
                        }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="font-semibold text-green-800"
                            >Order Status</span
                        >
                        <span class="text-gray-500">{{ order.status }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="font-semibold text-green-800"
                            >Ordered On</span
                        >
                        <span class="text-gray-500">{{ dateString }}</span>
                    </li>
                </ul>
            </div>
        </section>
    </AppLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionTitle from "@/Components/SectionTitle.vue";
import OrderItem from "@/Components/OrderItem.vue";
import { computed } from "vue";

const { order } = defineProps({
    order: Object,
});

const totalItems = computed(() => {
    return order?.items.reduce((carry, curr) => {
        return carry + curr.pivot.quantity;
    }, 0);
});

const dateString = computed(() => {
    return new Date(order.order_date).toDateString();
});
</script>
