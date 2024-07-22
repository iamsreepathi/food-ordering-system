<template>
    <nav class="px-4 py-2 space-y-2">
        <div class="flex flex-wrap items-center justify-between space-y-2">
            <Link class="font-bold text-xl tracking-wide" href="/"
                >Food Mania</Link
            >
            <div class="hidden space-x-4 text-sm md:flex items-center">
                <Link
                    v-for="(link, idx) in routes"
                    :key="idx"
                    class="hover:underline"
                    :class="{ active: $page.url === link.href }"
                    :href="link.href"
                    >{{ link.title }}</Link
                >
                <Link
                    class="hover:underline"
                    :class="{ active: $page.url === '/cart' }"
                    href="/cart"
                >
                    <div class="flex items-center">
                        <TheCart :fill="true" />
                        <span
                            v-show="props.cart.count"
                            class="rounded-full bg-green-900 text-white px-1 text-xs"
                            >{{ props.cart.count }}</span
                        >
                    </div>
                </Link>
                <button-link
                    class="rounded-full"
                    v-show="$page.url != '/login' && !props.auth.user"
                    link="/login"
                    >Sign In / Join</button-link
                >
                <UserProfile v-if="props.auth.user" :user="props.auth.user" />
            </div>
            <div
                v-if="!open"
                class="hover:cursor-pointer md:hidden"
                @click="onNavClick"
            >
                <HamburgerMenu :fill="true" />
            </div>
            <div
                v-else
                class="hover:cursor-pointer md:hidden"
                @click="onNavClick"
            >
                <XMark :fill="true" />
            </div>
        </div>
        <TransitionGroup
            tag="div"
            enter-from-class="-translate-y-full opacity-0"
            enter-active-class="duration-200"
            leave-active-class="duration-200"
            leave-to-class="-translate-y-full opacity-0"
            ><div v-if="open" class="grid grid-cols-1 gap-2 md:hidden">
                <Link
                    v-for="(link, idx) in routes"
                    :key="idx"
                    class="hover:underline px-4 hover:bg-gray-100 py-1 rounded"
                    :class="{ active: $page.url === link.href }"
                    :href="link.href"
                    >{{ link.title }}</Link
                >
                <Link
                    class="hover:underline px-4 flex hover:bg-gray-100 py-1 rounded"
                    :class="{ active: $page.url === '/cart' }"
                    href="/cart"
                >
                    <span>Cart</span>
                    <TheCart :fill="true" />
                </Link>
                <button-link
                    class="rounded text-center"
                    v-show="$page.url != '/login' && !props.auth.user"
                    link="/login"
                    >Sign In / Join</button-link
                >
                <UserProfile
                    class="px-4"
                    v-if="props.auth.user"
                    :user="props.auth.user"
                    :mobile="true"
                /></div
        ></TransitionGroup>
    </nav>
</template>

<script setup>
import ButtonLink from "@/Components/ButtonLink.vue";
import TheCart from "@/Components/icons/TheCart.vue";
import { usePage, Link } from "@inertiajs/vue3";
import UserProfile from "@/Components/UserProfile.vue";
import HamburgerMenu from "@/Components/icons/HamburgerMenu.vue";
import XMark from "@/Components/icons/XMark.vue";
import { ref } from "vue";
import { routes } from "@/Utils/AppRoutes";

const { props } = usePage();
const open = ref(false);

const onNavClick = () => {
    open.value = !open.value;
};
</script>
