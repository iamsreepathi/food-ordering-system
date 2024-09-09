<template>
    <li class="border border-gray-100 shadow-sm rounded-md p-3">
        <div class="space-y-1 flex space-x-4">
            <div>
                <img class="w-32" :src="item.image_url" :alt="item.name" />
            </div>
            <div class="space-y-1 w-full text-xs md:text-sm">
                <h2 class="font-semibold">{{ item.name }}</h2>
                <p>{{ $filters.currencyUSD(item.price) }}</p>
                <p class="text-gray-400 hidden md:block">
                    {{ item.short_description }}
                </p>
                <p class="text-gray-400">
                    Quantity:
                    <span class="text-green-900">{{
                        item.pivot.quantity
                    }}</span>
                </p>
                <ButtonSubmit @click="openModal" class="rounded"
                    >Write a Review</ButtonSubmit
                >
            </div>
        </div>
    </li>
</template>

<script setup>
import ButtonSubmit from "@/Components/ButtonSubmit.vue";
const event = "open";
defineProps({
    item: Object,
});
const emit = defineEmits([event]);
const openModal = () => {
    emit(event);
};
</script>
