<template>
    <Head>
        <title>Order Summary | Spice Savor</title>
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
                        @open="openModal(item)"
                    />
                </ul>
                <TheModal
                    :isOpen="isOpen"
                    title="Write a Review"
                    buttonText="Add Review"
                    @close="closeModal"
                    @submit="submitForm"
                >
                    <form class="space-y-2">
                        <div class="space-y-2">
                            <label class="font-medium" for="review"
                                >Review</label
                            >
                            <textarea
                                class="block border rounded outline-none p-2 w-full"
                                placeholder="Write a review"
                                type="text"
                                id="review"
                                v-model="form.review"
                            />
                            <FormError
                                v-if="form.errors.review"
                                :message="form.errors.review"
                            />
                        </div>
                        <div class="space-y-2">
                            <label class="font-medium" for="rating"
                                >Rating</label
                            >
                            <select
                                class="block border rounded p-2 outline-none w-full"
                                v-model="form.rating"
                                id="rating"
                            >
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <FormError
                                v-if="form.errors.rating"
                                :message="form.errors.rating"
                            />
                        </div>
                    </form>
                </TheModal>
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
import { Head, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionTitle from "@/Components/SectionTitle.vue";
import OrderItem from "@/Components/OrderItem.vue";
import { computed, onMounted, ref } from "vue";
import { OrderStatus } from "../Utils/Enum";
import StatusBadge from "../Components/StatusBadge.vue";
import TheModal from "@/Components/TheModal.vue";
import FormError from "@/Components/FormError.vue";

const { order } = defineProps({
    order: Object,
});

const positions = {
    [OrderStatus.RECEIVED]: 0,
    [OrderStatus.PREPARING]: 1,
    [OrderStatus.READY]: 2,
    [OrderStatus.COMPLETED]: 3,
};

const form = useForm({
    itemId: null,
    review: null,
    rating: 1,
});

const currPos = ref(positions[order.status]);
const isOpen = ref(false);

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

const openModal = (item) => {
    form.itemId = item.id;
    isOpen.value = true;
};

const closeModal = () => {
    isOpen.value = false;
};

const submitForm = () => {
    form.post(`/menu-item/${form.itemId}/review`);
    closeModal();
    form.reset();
};
</script>
