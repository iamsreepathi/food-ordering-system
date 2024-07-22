<template>
    <footer class="border-t p-4">
        <div
            class="grid grid-cols-1 md:grid-cols-3 gap-2 text-center md:text-left"
        >
            <a class="font-bold text-xl tracking-wide" href="/">Food Mania</a>
            <p class="text-sm text-center">
                &copy; 2024 Food Mania. All rights reserved.
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
