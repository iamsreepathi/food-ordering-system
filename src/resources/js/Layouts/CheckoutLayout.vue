<template>
    <Head title="Checkout Your Order | Spice Savor" />
    <ToastList />
    <nav class="p-4 lg:container lg:mx-auto">
        <div class="flex flex-wrap items-center justify-between">
            <Link class="font-bold text-xl tracking-wide" href="/">
                <img src="/images/logo.png" class="h-12" alt="logo" />
            </Link>
            <div class="space-x-4 text-sm flex items-center">
                <Link class="hover:underline flex items-center" href="/cart">
                    <TheCart :fill="true" />
                    <span
                        v-show="props.cart.count"
                        class="rounded-full bg-green-900 text-white px-1 text-xs"
                        >{{ props.cart.count }}</span
                    >
                </Link>
            </div>
        </div>
    </nav>
    <main class="lg:container lg:mx-auto space-y-4">
        <slot></slot>
    </main>
    <footer class="border-t p-4 lg:container lg:mx-auto">
        <div
            class="grid grid-cols-1 md:grid-cols-2 gap-2 text-center md:text-left"
        >
            <a class="font-bold text-xl tracking-wide" href="/">Spice Savor</a>
            <p class="text-sm text-right">
                &copy; 2024 Spice Savor. All rights reserved.
            </p>
        </div>
    </footer>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import ToastList from "@/Components/ToastList.vue";
import TheCart from "@/Components/icons/TheCart.vue";
import { usePage, Link } from "@inertiajs/vue3";

const { props } = usePage();
</script>
