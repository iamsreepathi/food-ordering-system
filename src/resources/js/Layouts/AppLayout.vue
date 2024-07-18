<template>
    <ToastList />
    <NavBar />
    <header v-show="header" id="post" class="bg-green-50">
        <div
            class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-4 p-4"
        >
            <div class="space-y-4 md:col-span-2">
                <div class="space-y-4">
                    <h1 class="text-3xl font-semibold tracking-wider">
                        Order Food anywhere anytime.
                    </h1>
                    <p class="text-gray-400 text-sm">
                        Lorem ipsum, dolor sit amet consectetur adipisicing
                        elit. Distinctio eveniet velit quasi voluptas, aliquam
                        sint impedit suscipit ea laboriosam quod.
                    </p>
                </div>
                <div
                    class="rounded-full py-1 px-2 bg-white flex justify-between items-center md:inline-block shadow-sm"
                >
                    <input
                        class="px-3 py-2 text-sm focus:outline-none"
                        type="text"
                        name="location"
                        id="location"
                        placeholder="Enter your location"
                    />
                    <button
                        class="bg-green-900 text-white py-1 px-3 text-sm rounded-full"
                    >
                        search
                    </button>
                </div>
            </div>
            <div class="flex items-center justify-center">
                <img
                    class="rounded-full h-60 w-60"
                    src="/images/pizza.jpg"
                    alt=""
                />
            </div>
        </div>
    </header>
    <main class="container mx-auto p-4 space-y-4">
        <slot></slot>
    </main>
    <TheFooter />
</template>

<script setup>
import NavBar from "@/Components/NavBar.vue";
import TheFooter from "@/Components/TheFooter.vue";
import ToastList from "@/Components/ToastList.vue";

defineProps({
    header: {
        type: Boolean,
        default: true,
    },
});
</script>
