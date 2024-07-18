<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="w-6 h-6 ms-1"
        :class="{ 'text-green-900': fill, 'text-gray-300': !fill }"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M6 18 18 6M6 6l12 12"
        />
    </svg>
</template>

<script setup>
defineProps({
    fill: {
        type: Boolean,
        default: false,
    },
});
</script>
