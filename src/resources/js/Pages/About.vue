<template>
    <Head>
        <title>About Us | Spice Savor</title>
    </Head>
    <AppLayout :header="false">
        <section class="grid grid-cols-2 md:grid-cols-3 gap-1 md:gap-4">
            <div class="space-y-2">
                <div class="p-2 bg-green-50 rounded-full inline-block">
                    <TheLocation class="size-10" />
                </div>
                <div class="space-y-2">
                    <p>{{ location.name }}</p>
                    <p>{{ location.address.line }}</p>
                    <p>
                        {{ location.address.city }},
                        {{ location.address.state }}
                    </p>
                    <p>
                        {{ location.address.country }},
                        {{ location.address.zipCode }}
                    </p>
                </div>
            </div>
            <div class="space-y-2">
                <div class="p-2 bg-green-50 rounded-full inline-block">
                    <TheContact class="size-10" />
                </div>
                <div class="space-y-2">
                    <p>{{ location.phone }}</p>
                    <p class="overflow-hidden">
                        <a href="mailto:johndoe@example.com">{{
                            location.email
                        }}</a>
                    </p>
                </div>
            </div>
        </section>
        <section>
            <div class="mt-10 space-y-2">
                <SectionTitle>Our Location</SectionTitle>
                <LocationMarker
                    :coords="{ lat: +location.lat, lng: +location.lng }"
                    :address="location.address"
                    :business="location.name"
                />
            </div>
        </section>
    </AppLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionTitle from "@/Components/SectionTitle.vue";
import LocationMarker from "@/Components/LocationMarker.vue";
import TheLocation from "@/Components/icons/TheLocation.vue";
import TheContact from "@/Components/icons/TheContact.vue";

defineProps({
    location: Object,
});
</script>
