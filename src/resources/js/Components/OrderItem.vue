<template>
    <li class="border border-gray-100 shadow-sm rounded-md p-4">
        <div class="space-y-1 flex space-x-4">
            <div>
                <img class="w-24" :src="item.image_url" :alt="item.name" />
            </div>
            <div class="space-y-1">
                <h2 class="font-semibold text-sm">{{ item.name }}</h2>
                <p class="text-sm">{{ $filters.currencyUSD(item.price) }}</p>
                <p class="text-sm text-gray-400">
                    {{ item.short_description }}
                </p>
                <p class="text-sm text-gray-400">
                    Quantity:
                    <span class="text-green-900">{{
                        item.pivot.quantity
                    }}</span>
                </p>
            </div>
        </div>
    </li>
</template>

<script setup>
defineProps({
    item: Object,
});
</script>
