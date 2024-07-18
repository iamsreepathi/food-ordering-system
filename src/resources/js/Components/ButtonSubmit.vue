<template>
    <button
        :disabled="disabled"
        :type="{ type }"
        class="border text-white text-sm font-semibold disabled:opacity-75 disabled:cursor-not-allowed"
        :class="defaultClass"
    >
        <slot></slot>
    </button>
</template>

<script setup>
defineProps({
    type: {
        type: String,
        default: "button",
    },
    disabled: {
        default: false,
        type: Boolean,
    },
    defaultClass: {
        type: String,
        default: "px-2 py-1 bg-green-900",
    },
});
</script>
