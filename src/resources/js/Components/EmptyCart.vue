<template>
    <div class="text-sm space-y-2">
        <p>Your cart is empty.</p>
        <div>
            <ButtonLink class="rounded-full" link="/menu"
                >Start Your Order</ButtonLink
            >
        </div>
    </div>
</template>

<script setup>
import ButtonLink from "@/Components/ButtonLink.vue";
</script>
