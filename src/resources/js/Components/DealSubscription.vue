<template>
    <section id="post" class="bg-green-50 p-2 md:p-10 rounded">
        <div class="space-y-4 text-center">
            <div>
                <h1 class="text-3xl font-semibold tracking-wider">
                    Subscribe to Our Deals!
                </h1>
                <p class="text-gray-400 text-sm">
                    By subscribing you agree to our terms and conditions to get
                    curated list of deals to your inbox.
                </p>
            </div>
            <form
                @submit.prevent="
                    form.post('/newsletter/subscription', {
                        preserveScroll: true,
                        preserveState: false,
                    })
                "
                class="md:space-x-2 space-y-4 md:space-y-0 md:flex items-start justify-center text-sm"
            >
                <div class="space-y-2">
                    <input
                        class="px-4 py-2 rounded-full outline-none w-full md:w-64"
                        placeholder="johndoe@example.com"
                        type="email"
                        name="email"
                        id="subscription"
                        v-model="form.email"
                    />
                    <FormError
                        class="text-left px-4"
                        v-if="form.errors.email"
                        :message="form.errors.email"
                    />
                </div>
                <div>
                    <ButtonSubmit
                        type="submit"
                        :disabled="form.processing"
                        class="rounded-full py-1.5 w-full"
                        >Subscribe</ButtonSubmit
                    >
                </div>
            </form>
        </div>
    </section>
</template>
<script setup>
import FormError from "@/Components/FormError.vue";
import ButtonSubmit from "@/Components/ButtonSubmit.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    email: null,
});
</script>
