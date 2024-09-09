<template>
    <footer class="border-t p-4">
        <div
            class="grid grid-cols-1 md:grid-cols-3 gap-2 text-center md:text-left"
        >
            <Link class="font-bold text-xl tracking-wide" href="/">
                <img src="/images/logo.png" class="h-12" alt="logo" />
            </Link>
            <p class="text-sm text-center">
                &copy; 2024 Spice Savor. All rights reserved.
            </p>
            <div class="space-x-4 text-sm md:text-right">
                <Link
                    v-for="(link, idx) in routes"
                    :key="idx"
                    class="hover:underline"
                    :href="link.href"
                    >{{ link.title }}</Link
                >
            </div>
        </div>
    </footer>
</template>

<script setup>
import { routes } from "@/Utils/AppRoutes";
import { Link } from "@inertiajs/inertia-vue3";
</script>
