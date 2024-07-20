<template>
    <Link class="p-1 px-2 text-white bg-green-900 text-sm" :href="link">
        <slot></slot>
    </Link>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
    link: String,
});
</script>
