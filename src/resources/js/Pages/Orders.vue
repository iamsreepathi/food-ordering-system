<template>
    <Head>
        <title>Recent Orders | Food Mania</title>
    </Head>
    <AppLayout>
        <section class="space-y-4">
            <SectionTitle>Your Recent Orders</SectionTitle>

            <div
                class="relative overflow-x-auto shadow-sm sm:rounded-lg border border-gray-200"
            >
                <TheTable :columns="columns" :data="orders" action="orders" />
            </div>
        </section>
    </AppLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionTitle from "@/Components/SectionTitle.vue";
import TheTable from "@/Components/TheTable.vue";

const columns = [
    {
        header: "Order Id",
        property: "id",
    },
    {
        header: "Status",
        property: "status",
    },
    {
        header: "Ordered On",
        property: "order_date",
    },
    {
        header: "Total",
        property: "total_amount",
    },
];

defineProps({
    orders: Array,
});
</script>
