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
            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
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
