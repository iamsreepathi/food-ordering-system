<template>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-800 uppercase bg-green-50">
            <tr>
                <th
                    v-for="(col, idx) in columns"
                    :key="idx"
                    scope="col"
                    class="px-6 py-3"
                >
                    {{ col.header }}
                </th>
                <th v-show="view" scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <tr v-show="data.length === 0" class="bg-white hover:bg-gray-50">
                <td class="px-6 py-4">You have 0 orders.</td>
            </tr>
            <tr
                v-for="rec in data"
                :key="rec.id"
                class="bg-white hover:bg-gray-50"
            >
                <td v-for="(col, idx) in columns" :key="idx" class="px-6 py-4">
                    {{ rec[col.property] }}
                </td>
                <td v-show="view" class="px-6 py-4 text-right">
                    <Link
                        :href="`/${action}/${rec.id}`"
                        class="font-medium p-2 hover:bg-green-100 hover:text-green-800 text-gray-400 rounded-full"
                        >&rarr;</Link
                    >
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    columns: Array,
    data: Array,
    action: String,
    view: {
        type: Boolean,
        default: true,
    },
});
</script>
