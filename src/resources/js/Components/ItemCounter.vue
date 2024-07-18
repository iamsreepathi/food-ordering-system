<template>
    <div>
        <button
            @click="onDecrement"
            type="button"
            class="border bg-green-200 rounded-l px-2"
        >
            -
        </button>
        <input
            class="w-8 outline-none bg-gray-50 text-center text-sm pb-0.5 pt-1"
            type="text"
            :value="qty"
        />
        <button
            @click="onIncrement"
            type="button"
            class="border bg-green-200 rounded-r px-2"
        >
            +
        </button>
    </div>
</template>

<script setup>
const event = "updateQuantity";

defineProps({
    qty: Number,
});

const emit = defineEmits([event]);

const onIncrement = () => {
    emit(event, true);
};

const onDecrement = () => {
    emit(event, false);
};
</script>
