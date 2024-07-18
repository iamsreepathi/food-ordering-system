<template>
    <form
        @submit.prevent="form.post('/logout')"
        class="px-4 py-2 hover:bg-gray-100"
    >
        <button :disabled="form.processing" class="rounded-full" type="submit">
            Sign Out
        </button>
    </form>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({});
</script>
