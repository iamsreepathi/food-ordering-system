<template>
    <div ref="dropdown">
        <button
            id="dropdownUserAvatarButton"
            data-dropdown-toggle="dropdownAvatar"
            class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300"
            type="button"
            @click="onToggle"
        >
            <span class="sr-only">Open user menu</span>
            <img
                class="w-8 h-8 rounded-full"
                src="/images/avatar.png"
                alt="user avatar"
            />
        </button>
        <div
            id="dropdownAvatar"
            class="absolute z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44"
            :class="{ hidden: !toggle, 'right-1': !mobile, 'left-6': mobile }"
        >
            <div class="px-4 py-3 text-sm">
                <div>{{ user.name }}</div>
            </div>
            <ul
                class="text-sm divide-y divide-gray-100"
                aria-labelledby="dropdownUserAvatarButton"
            >
                <li>
                    <Link href="#" class="block px-4 py-2 hover:bg-gray-100"
                        >Profile</Link
                    >
                </li>
                <li>
                    <Link
                        href="/orders"
                        class="block px-4 py-2 hover:bg-gray-100"
                        >Orders</Link
                    >
                </li>
            </ul>
            <div>
                <SignOut />
            </div>
        </div>
    </div>
</template>
<script setup>
import { onBeforeMount, onMounted, ref } from "vue";
import { Link } from "@inertiajs/vue3";
import SignOut from "@/Components/SignOut.vue";

defineProps({
    user: Object,
    mobile: false,
});

const toggle = ref(false);

const dropdown = ref(null);

function onToggle() {
    toggle.value = !toggle.value;
}

function close(e) {
    if (!dropdown.value?.contains(e.target)) {
        toggle.value = false;
    }
}

onMounted(() => {
    document.addEventListener("click", close);
});

onBeforeMount(() => {
    document.removeEventListener("click", close);
});
</script>
