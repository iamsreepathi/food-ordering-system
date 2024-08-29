<template>
    <Head>
        <title>Order Summary | Food Mania</title>
    </Head>
    <AppLayout>
        <section class="space-y-4">
            <div class="space-y-2 hidden md:block">
                <SectionTitle>Order Status</SectionTitle>
                <ul class="grid grid-cols-4 text-sm text-gray-400">
                    <StatusBadge
                        :title="OrderStatus.RECEIVED"
                        :currenPos="currPos"
                        :start="false"
                        :position="0"
                    />
                    <StatusBadge
                        :title="OrderStatus.PREPARING"
                        :currenPos="currPos"
                        :position="1"
                    />
                    <StatusBadge
                        :title="OrderStatus.READY"
                        :currenPos="currPos"
                        :position="2"
                    />
                    <StatusBadge
                        :title="OrderStatus.COMPLETED"
                        :currenPos="currPos"
                        :end="false"
                        :position="3"
                    />
                </ul>
            </div>
            <div class="space-y-4">
                <SectionTitle>Items Purchased</SectionTitle>
                <ul class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                    <OrderItem
                        v-for="item in order.items"
                        :key="item.id"
                        :item="item"
                    />
                </ul>
            </div>
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
                    <li class="flex justify-between md:hidden">
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
import { computed, onMounted, ref } from "vue";
import { OrderStatus } from "../Utils/Enum";
import StatusBadge from "../Components/StatusBadge.vue";

const { order } = defineProps({
    order: Object,
});

const positions = {
    [OrderStatus.RECEIVED]: 0,
    [OrderStatus.PREPARING]: 1,
    [OrderStatus.READY]: 2,
    [OrderStatus.COMPLETED]: 3,
};

const currPos = ref(positions[order.status]);

onMounted(() => {
    window.Echo.channel(`order.${order.id}`).listen("OrderStatus", (event) => {
        currPos.value = positions[event.status];
    });
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
