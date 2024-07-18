<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 p-4">
        <div class="flex items-start space-x-2">
            <LockClosed />
            <h3 class="text-2xl">Secure Checkout</h3>
        </div>
        <div>
            <h3 class="font-semibold">Have an Account?</h3>
            <p class="text-gray-400 text-sm">
                <span class="text-green-900 font-semibold hover:underline"
                    ><Link href="/login">Login</Link></span
                >
                for faster checkout experience
            </p>
        </div>
    </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
import LockClosed from "@/Components/icons/LockClosed.vue";
</script>
