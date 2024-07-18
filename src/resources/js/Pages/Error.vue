<template>
    <ErrorLayout>
        <section class="flex justify-center items-center h-screen -mt-20">
            <div class="w-full md:w-1/2 text-red-600 text-center">
                <div class="space-y-2">
                    <div
                        class="flex divide-red-600 divide-x-2 items-center justify-center"
                    >
                        <h2 class="font-semibold text-lg pr-2">
                            {{ status }}
                        </h2>
                        <h2 class="font-semibold text-lg pl-2">
                            {{ error.title }}
                        </h2>
                    </div>
                    <p class="text-sm text-red-500">{{ error.description }}</p>
                    <div class="py-2">
                        <ButtonLink link="/" class="rounded bg-red-600"
                            >Back To Home</ButtonLink
                        >
                    </div>
                </div>
            </div>
        </section>
    </ErrorLayout>
</template>

<script setup>
import { computed } from "vue";
import ErrorLayout from "@/Layouts/ErrorLayout.vue";
import ButtonLink from "@/Components/ButtonLink.vue";

const errors = {
    503: {
        title: "Service Unavailable",
        description:
            "Sorry, we are doing some maintenance. Please check back soon.",
    },
    500: {
        title: "Server Error",
        description: "Whoops, something went wrong on our servers.",
    },
    400: {
        title: "Page Not Found",
        description: "Sorry, the page you are looking for could not be found.",
    },
    403: {
        title: "Forbidden",
        description: "Sorry, you are forbidden from accessing this page.",
    },
};

const props = defineProps({
    status: Number,
});

const error = computed(() => {
    return errors[props.status];
});
</script>
