<template>
    <li class="border text-sm text-gray-400 p-2 rounded-md space-y-2">
        <div class="flex items-center space-x-2">
            <p class="text-green-900 font-semibold">
                {{ rating?.user.name }}
            </p>
            <p class="text-xs text-gray-400">
                {{ rating?.ratedOn }}
            </p>
        </div>
        <p>{{ rating?.review }}</p>
        <div class="flex space-x-1">
            <TheStar
                v-for="star in maxRating"
                :key="star"
                :fill="star <= rating?.rating"
            />
        </div>
    </li>
</template>

<script setup>
import TheStar from "@/Components/icons/TheStar.vue";

defineProps({
    rating: Object,
    maxRating: Number,
});
</script>
