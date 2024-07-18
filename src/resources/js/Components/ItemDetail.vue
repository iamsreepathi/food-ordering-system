<template>
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="flex justify-center border p-2 border-gray-300 rounded">
            <img :src="item?.image_url" :alt="item?.name" class="lg:w-2/3" />
        </div>
        <div class="space-y-4 lg:col-span-2">
            <h2 class="font-semibold">{{ item?.name }}</h2>
            <h4 class="font-semibold text-sm">
                {{ item?.short_description }}
            </h4>
            <p class="text-gray-400 text-sm">{{ item?.description }}</p>
            <p class="text-sm">{{ $filters.currencyUSD(item?.price) }}</p>
            <form
                class="space-y-4"
                @submit.prevent="form.post(`/cart/${item.id}/add`)"
            >
                <div class="space-y-1">
                    <ItemCounter
                        @updateQuantity="onQtyUpdate"
                        :qty="form.quantity"
                    />
                    <FromError
                        v-if="form.errors.quantity"
                        :message="form.errors.quantity"
                    />
                </div>
                <div class="text-sm">
                    <div class="space-y-2">
                        <label class="font-semibold" for="instructions"
                            >Special Instructions</label
                        >
                        <textarea
                            name="instructions"
                            id="instructions"
                            rows="3"
                            class="border w-full border-gray-200 p-2 outline-none text-gray-400 rounded"
                            placeholder="Add your instructions here..."
                            v-model="form.instructions"
                        ></textarea>
                    </div>
                    <FromError
                        v-if="form.errors.instructions"
                        :message="form.errors.instructions"
                    />
                </div>

                <ButtonSubmit
                    :disabled="form.processing"
                    class="rounded-md w-full"
                    type="submit"
                    >Add to cart</ButtonSubmit
                >
            </form>
        </div>
    </section>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import ItemCounter from "@/Components/ItemCounter.vue";
import ButtonSubmit from "@/Components/ButtonSubmit.vue";
import FromError from "@/Components/FormError.vue";

const props = defineProps({
    item: Object,
});

const form = useForm({
    quantity: 1,
    instructions: null,
});

const onQtyUpdate = (inc) => {
    if (inc) form.quantity += 1;
    if (!inc && form.quantity != 1) form.quantity -= 1;
};
</script>
