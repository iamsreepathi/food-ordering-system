<template>
    <li class="border border-gray-100 shadow-sm hover:shadow-md p-2 rounded-md">
        <Link
            :href="`/menu-item/${item.id}`"
            class="space-y-2 flex justify-center items-center space-x-4"
        >
            <div class="w-1/4">
                <img :src="item.image_url" :alt="item.name" />
            </div>
            <div class="space-y-4 w-3/4">
                <p class="font-semibold">{{ item.name }}</p>
                <p class="text-sm text-gray-400">
                    {{ item.description }}
                </p>
                <p>{{ $filters.currencyUSD(item.price) }}</p>
            </div>
        </Link>
    </li>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    item: Object,
});
</script>
