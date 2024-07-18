<template>
    <TransitionGroup
        tag="div"
        enter-from-class="translate-x-full opacity-0"
        enter-active-class="duration-500"
        leave-active-class="duration-500"
        leave-to-class="translate-x-full opacity-0"
        class="fixed top-4 right-4 z-50 w-full max-w-xs space-y-4"
    >
        <ToastListItem
            v-for="(item, index) in toast.items"
            :key="item.key"
            :message="item.message"
            :duration="3000"
            @remove="remove(index)"
        />
    </TransitionGroup>
</template>
<script setup>
import { usePage } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import ToastListItem from "@/Components/ToastListItem.vue";
import { onUnmounted } from "vue";
import toast from "@/Stores/toast";

const page = usePage();

let removeFinishEventListener = Inertia.on("finish", () => {
    const message = page.props.flash.message;
    if (message) {
        toast.add({
            message,
        });
    }
});

onUnmounted(() => removeFinishEventListener());

function remove(index) {
    toast.remove(index);
}
</script>
