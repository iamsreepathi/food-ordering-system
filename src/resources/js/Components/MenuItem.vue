<template>
    <div class="border shadow-md rounded">
        <div>
            <img src="/images/item.jpeg" :alt="item.name" />
        </div>
        <div class="p-2 space-y-2">
            <p class="font-semibold text-sm">
                {{ item.name }}
            </p>
            <p class="text-sm font-semibold">
                {{ $filters.currencyUSD(item.price) }}
            </p>
            <p class="text-gray-500 text-sm">
                {{ item.short_description }}
            </p>
            <button-link
                :link="`menu-item/${item.id}`"
                class="text-sm block text-center rounded-full"
                >Order</button-link
            >
        </div>
    </div>
</template>

<script setup>
import ButtonLink from "@/Components/ButtonLink.vue";

defineProps({
    item: Object,
});
</script>
