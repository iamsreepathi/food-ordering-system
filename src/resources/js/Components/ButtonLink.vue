<template>
    <a class="p-1 px-2 text-white bg-green-900 text-sm" :href="link">
        <slot></slot>
    </a>
</template>

<script setup>
defineProps({
    link: String,
});
</script>
