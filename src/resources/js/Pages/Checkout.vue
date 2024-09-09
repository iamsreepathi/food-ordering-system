<template>
    <CheckoutLayout>
        <section
            class="sm:flex sm:justify-between sm:items-start p-4 space-y-2 sm:space-y-0"
        >
            <div class="flex items-start space-x-4">
                <div class="bg-gray-100 p-2 rounded-full">
                    <TheLocation class="size-8" />
                </div>
                <div class="text-sm">
                    <h2 class="font-semibold text-base">Pickup Restaurant</h2>
                    <p>123 South 21st Street,</p>
                    <p>Sioux Falls, SD 57108</p>
                </div>
            </div>
            <div class="flex items-start space-x-4">
                <div class="bg-gray-100 p-2 rounded-full">
                    <TheClock />
                </div>
                <div class="text-sm">
                    <h2 class="font-semibold text-base">
                        Pickup Date and Time
                    </h2>
                    <p>Today, Jul 8th, 3:50 PM</p>
                </div>
            </div>
        </section>
        <hr />
        <section>
            <SecureCheckout />
            <hr />
        </section>
        <section class="grid grid-cols-1 md:grid-cols-3 px-4 pb-4 gap-4">
            <div class="md:col-span-2 space-y-2">
                <div class="space-y-2">
                    <p class="font-semibold text-lg">Order Instructions</p>
                    <form
                        id="checkout-form"
                        @submit.prevent="onSubmit"
                        class="space-y-2"
                    >
                        <div class="p-4 bg-gray-100 rounded space-y-4">
                            <p>
                                Include Silverware*
                                <span class="text-sm text-gray-400"
                                    >(Forks, Knives, Spoons and Napkins)</span
                                >
                            </p>
                            <div class="flex space-x-4">
                                <div class="flex space-x-4">
                                    <input
                                        type="radio"
                                        name="silverware"
                                        id="silverwareyes"
                                        value="1"
                                        v-model="form.silverware"
                                    />
                                    <label for="silverwareyes">Yes</label>
                                </div>
                                <div class="flex space-x-4">
                                    <input
                                        type="radio"
                                        name="silverware"
                                        id="silverwareno"
                                        value="0"
                                        v-model="form.silverware"
                                    />
                                    <label for="silverwareno">No</label>
                                </div>
                            </div>
                            <FormError :message="form.errors.silverware" />
                        </div>
                        <div class="space-y-2">
                            <label for="instructions"
                                >Special Instructions</label
                            >
                            <textarea
                                name="instructions"
                                id="instructions"
                                rows="2"
                                class="w-full text-sm border p-2 outline-none rounded"
                                placeholder="Add any special instructions for this order"
                                v-model="form.instructions"
                            ></textarea>
                            <FormError :message="form.errors.instructions" />
                        </div>
                        <div class="space-y-2">
                            <p>Is someone else picking up the order?</p>
                            <div class="flex space-x-4">
                                <div class="flex space-x-4">
                                    <input
                                        type="radio"
                                        name="pickup"
                                        id="pick_yes"
                                        value="1"
                                        v-model="form.pickup"
                                    />
                                    <label for="pick_yes">Yes</label>
                                </div>
                                <div class="flex space-x-4">
                                    <input
                                        type="radio"
                                        name="pickup"
                                        id="pick_no"
                                        value="0"
                                        v-model="form.pickup"
                                    />
                                    <label for="pick_no">No</label>
                                </div>
                            </div>
                            <FormError :message="form.errors.pickup" />
                        </div>
                        <!-- <div class="space-y-2">
                            <p class="font-semibold text-lg mt-8">
                                Delivery Address
                            </p>
                            <div class="space-y-2">
                                <label for="street">Street address</label>
                                <input
                                    class="block border rounded outline-none p-2 w-full"
                                    placeholder="456 Elm street, Apt#123"
                                    type="text"
                                    id="street"
                                    v-model="form.street"
                                />
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <div class="space-y-2">
                                    <label for="city">city</label>
                                    <input
                                        class="block border rounded outline-none p-2 w-full"
                                        type="text"
                                        id="city"
                                        placeholder="Dell Rapids"
                                        v-model="form.city"
                                    />
                                </div>
                                <div class="space-y-2">
                                    <label for="state">State</label>
                                    <input
                                        class="block border rounded outline-none p-2 w-full"
                                        type="text"
                                        id="state"
                                        placeholder="SD"
                                        v-model="form.state"
                                    />
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <div class="space-y-2">
                                    <label for="country">Country</label>
                                    <input
                                        class="block border rounded outline-none p-2 w-full"
                                        type="text"
                                        id="country"
                                        placeholder="USA"
                                        v-model="form.country"
                                    />
                                </div>
                                <div class="space-y-2">
                                    <label for="zipcode">Zipcode</label>
                                    <input
                                        class="block border rounded outline-none p-2 w-full"
                                        type="number"
                                        id="zipcode"
                                        placeholder="50912"
                                        v-model="form.state"
                                    />
                                </div>
                            </div>
                        </div> -->
                        <CheckoutSummary
                            :items="items"
                            class="block md:hidden"
                        />
                        <div>
                            <ButtonSubmit
                                :disabled="form.processing"
                                type="submit"
                                class="w-full rounded"
                                >Place Your Order</ButtonSubmit
                            >
                        </div>
                    </form>
                </div>
            </div>
            <CheckoutSummary :items="items" class="hidden md:block" />
        </section>
    </CheckoutLayout>
</template>
<script setup>
import CheckoutLayout from "@/Layouts/CheckoutLayout.vue";
import TheLocation from "@/Components/icons/TheLocation.vue";
import TheClock from "@/Components/icons/TheClock.vue";
import SecureCheckout from "@/Components/SecureCheckout.vue";
import ButtonSubmit from "@/Components/ButtonSubmit.vue";
import { useForm } from "@inertiajs/vue3";
import FormError from "@/Components/FormError.vue";
import CheckoutSummary from "@/Components/CheckoutSummary.vue";

defineProps({
    items: Array,
});

const form = useForm({
    silverware: null,
    instructions: null,
    pickup: null,
});

function onSubmit() {
    form.post("/checkout");
}
</script>
