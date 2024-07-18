<template>
    <div class="text-sm text-center font-medium">
        <Link
            :href="`${prev}#ratings`"
            v-if="prev"
            class="py-1 px-2 border-y border-l rounded-l"
        >
            Prev
        </Link>
        <span
            v-else="!prev"
            class="py-1 px-2 border-y border-l rounded-l bg-gray-100 cursor-not-allowed"
        >
            Prev
        </span>
        <Link
            :href="`${next}#ratings`"
            v-if="next"
            class="py-1 px-2 border rounded-r"
            >Next</Link
        >
        <span
            v-else="!next"
            class="py-1 px-2 border rounded-r bg-gray-100 cursor-not-allowed"
        >
            Next
        </span>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    prev: String,
    next: String,
});
</script>
