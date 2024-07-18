<template>
    <div class="text-red-600 text-xs">
        {{ message }}
    </div>
</template>

<script setup>
defineProps({
    message: String,
});
</script>
