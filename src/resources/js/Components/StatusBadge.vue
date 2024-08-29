<template>
    <li class="relative flex py-5 items-center">
        <div
            v-show="start"
            class="flex-grow border-t"
            :class="{
                'border-green-700': position <= currenPos,
            }"
        ></div>
        <span
            :class="{
                'text-green-700 border-green-700': position <= currenPos,
            }"
            class="flex-shrink border rounded-full py-1 px-2"
            >{{ title }}</span
        >
        <div
            v-show="end"
            class="flex-grow border-t"
            :class="{
                'border-green-700': position <= currenPos,
            }"
        ></div>
    </li>
</template>
<script setup>
const props = defineProps({
    currenPos: Number,
    title: String,
    position: Number,
    start: {
        default: true,
    },
    end: {
        default: true,
    },
});
</script>
