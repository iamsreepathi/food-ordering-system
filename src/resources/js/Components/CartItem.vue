<template>
    <li
        :class="{
            'border border-gray-100 shadow-sm hover:shadow-md rounded-md hover:cursor-pointer p-2':
                long,
            'py-2': !long,
        }"
    >
        <div
            v-if="long"
            class="space-y-1 flex justify-center items-center space-x-4"
        >
            <div class="w-1/4">
                <img :src="item?.item.image_url" :alt="item?.item.name" />
            </div>
            <div class="lg:col-span-2 w-3/4">
                <div class="flex items-center justify-between">
                    <h2 class="font-semibold text-sm">{{ item?.item.name }}</h2>
                    <div class="flex items-center space-x-4">
                        <p class="text-xs">
                            {{ $filters.currencyUSD(item?.item.price) }}
                        </p>
                        <form
                            v-show="long"
                            @submit.prevent="
                                form.delete(`/cart/${item?.item.id}`, {
                                    preserveState: false,
                                })
                            "
                        >
                            <ButtonSubmit
                                :disabled="form.processing"
                                defaultClass="rounded-md w-full p-1 text-gray-700 hover:border-green-900"
                                type="submit"
                            >
                                <TrashCan />
                            </ButtonSubmit>
                        </form>
                    </div>
                </div>
                <div v-show="long" class="space-y-2">
                    <p class="text-xs text-gray-400">
                        {{ item?.item.short_description }}
                    </p>
                    <form
                        class="space-y-1"
                        @submit.prevent="
                            form.put(`/cart/${item?.item.id}`, {
                                preserveState: false,
                            })
                        "
                    >
                        <div class="space-y-1">
                            <ItemCounter
                                @updateQuantity="onQtyUpdate"
                                :qty="form.quantity"
                            />
                            <FormError
                                v-if="form.errors.quantity"
                                :message="form.errors.quantity"
                            />
                        </div>
                        <div class="text-sm pt-1">
                            <textarea
                                name="instructions"
                                id="instructions"
                                rows="2"
                                class="border w-full border-gray-200 p-2 outline-none text-gray-400 rounded"
                                placeholder="Add your instructions here..."
                                v-model="form.instructions"
                            ></textarea>
                            <FormError
                                v-if="form.errors.instructions"
                                :message="form.errors.instructions"
                            />
                        </div>
                        <ButtonSubmit
                            :disabled="form.processing"
                            class="rounded-md w-full"
                            type="submit"
                            >Update</ButtonSubmit
                        >
                    </form>
                </div>
            </div>
        </div>
        <div v-else class="flex justify-between">
            <p class="text-sm">{{ item?.item.name }}</p>
            <p class="text-sm">{{ $filters.currencyUSD(item?.item.price) }}</p>
        </div>
    </li>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import ItemCounter from "@/Components/ItemCounter.vue";
import FormError from "@/Components/FormError.vue";
import ButtonSubmit from "@/Components/ButtonSubmit.vue";
import TrashCan from "@/Components/icons/TrashCan.vue";

const props = defineProps({
    item: Object,
    long: {
        type: Boolean,
        default: true,
    },
});

const form = useForm({
    quantity: props.item?.quantity,
    instructions: props.item?.instructions,
});

const onQtyUpdate = (inc) => {
    if (inc) form.quantity += 1;
    if (!inc && form.quantity != 1) form.quantity -= 1;
};
</script>
