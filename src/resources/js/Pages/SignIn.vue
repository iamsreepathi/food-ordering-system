<template>
    <AppLayout :header="false">
        <section class="flex justify-center items-center h-screen -mt-20">
            <div class="w-full md:w-1/2 border p-4 rounded space-y-2 shadow-sm">
                <form @submit.prevent="onSubmit" class="text-sm space-y-2">
                    <h2 class="font-semibold text-center text-lg">Sign In</h2>
                    <div class="space-y-2">
                        <label class="font-semibold" for="email"
                            >Email Address</label
                        >
                        <input
                            class="block border rounded outline-none p-2 w-full"
                            placeholder="johndoe@example.com"
                            type="email"
                            id="email"
                            v-model="form.email"
                        />
                        <FormError
                            v-if="form.errors.email"
                            :message="form.errors.email"
                        />
                    </div>
                    <div class="space-y-2">
                        <label class="font-semibold" for="password"
                            >Password</label
                        >
                        <input
                            class="block border rounded outline-none p-2 w-full"
                            type="password"
                            id="password"
                            placeholder="password"
                            v-model="form.password"
                        />
                    </div>
                    <ButtonSubmit
                        :disabled="form.processing"
                        type="submit"
                        class="rounded-md w-full"
                        >Sign In</ButtonSubmit
                    >
                </form>
                <div class="text-xs">
                    <p class="text-gray-400">
                        By continuing, you agree to
                        <span class="text-green-800 underline"
                            >Food Mania's Conditions</span
                        >
                        of Use and
                        <span class="text-green-800 underline"
                            >Privacy Notice</span
                        >.
                    </p>
                </div>
                <div class="text-xs text-gray-400 space-y-2">
                    <p>New to Food Mania?</p>
                    <ButtonLink
                        class="rounded-md block text-center font-semibold"
                        link="#"
                        >Create your Food Mania account</ButtonLink
                    >
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import ButtonSubmit from "@/Components/ButtonSubmit.vue";
import ButtonLink from "@/Components/ButtonLink.vue";
import FormError from "@/Components/FormError.vue";

const form = useForm({
    email: null,
    password: null,
});

function onSubmit() {
    form.post("/login");
}
</script>
