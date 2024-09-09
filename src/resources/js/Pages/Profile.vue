<template>
    <Head>
        <title>South Indian Cuisine | User Profile</title>
    </Head>
    <AppLayout :header="false">
        <section class="grid grid-cols-1 md:grid-cols-3 gap-4 items-start">
            <div
                class="space-y-2 text-center border rounded border-gray-100 p-4 md:col-span-1"
            >
                <div class="flex justify-center">
                    <img
                        class="w-16 h-16 rounded-full"
                        src="/images/avatar.png"
                        alt="user avatar"
                    />
                </div>
                <div class="text-xs font-semibold space-y-2">
                    <p>{{ user.name }}</p>
                    <p>{{ user.email }}</p>
                </div>
            </div>
            <div class="md:col-span-2 space-y-4">
                <div>
                    <div class="flex space-x-2 items-center">
                        <h3 class="font-semibold text-lg">
                            Your Favorite Items
                        </h3>
                        <span><TheStar :fill="true" /></span>
                    </div>
                    <div class="text-sm">
                        <p class="text-gray-400">You have no favorites.</p>
                    </div>
                </div>
                <div>
                    <div class="flex space-x-2 items-center">
                        <h3 class="font-semibold text-lg">
                            Your Saved Addresses
                        </h3>
                    </div>
                    <div class="text-sm space-y-2">
                        <p class="text-gray-400">
                            You have no addresses saved. Please try adding one
                            below but we are not saving any addresses in this
                            version.
                        </p>
                        <form @submit.prevent="submitForm" class="space-y-2">
                            <div class="space-y-2">
                                <label class="font-medium" for="street"
                                    >Street address</label
                                >
                                <input
                                    class="block border rounded outline-none p-2 w-full"
                                    placeholder="456 Elm street, Apt#123"
                                    type="text"
                                    id="street"
                                    v-model="form.street"
                                    ref="inputRef"
                                />
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <div class="space-y-2">
                                    <label class="font-medium" for="city"
                                        >city</label
                                    >
                                    <input
                                        class="block border rounded outline-none p-2 w-full"
                                        type="text"
                                        id="city"
                                        placeholder="Dell Rapids"
                                        v-model="form.city"
                                    />
                                </div>
                                <div class="space-y-2">
                                    <label class="font-medium" for="state"
                                        >State</label
                                    >
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
                                    <label class="font-medium" for="country"
                                        >Country</label
                                    >
                                    <input
                                        class="block border rounded outline-none p-2 w-full"
                                        type="text"
                                        id="country"
                                        placeholder="USA"
                                        v-model="form.country"
                                    />
                                </div>
                                <div class="space-y-2">
                                    <label class="font-medium" for="zipcode"
                                        >Zipcode</label
                                    >
                                    <input
                                        class="block border rounded outline-none p-2 w-full"
                                        type="number"
                                        id="zipcode"
                                        placeholder="50912"
                                        v-model="form.zipcode"
                                    />
                                </div>
                            </div>
                            <ButtonSubmit
                                class="rounded-md w-full"
                                type="button"
                                >Add Address</ButtonSubmit
                            >
                        </form>
                    </div>
                </div>
                <div class="space-y-2">
                    <h3 class="font-semibold text-lg">Your Recent Orders</h3>
                    <ul
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 text-sm"
                    >
                        <li
                            v-for="order in orders"
                            :key="order.id"
                            class="border p-2 rounded hover:shadow-sm"
                        >
                            <Link
                                :href="`/orders/${order.id}`"
                                class="space-y-1"
                            >
                                <p class="font-semibold">
                                    Order {{ order.id }} #
                                </p>
                                <div class="flex justify-between">
                                    <p>Total Items Ordered</p>
                                    <p>{{ order.items_count }}</p>
                                </div>
                                <div class="flex justify-between">
                                    <p>Order Status</p>
                                    <p>{{ order.status }}</p>
                                </div>
                                <div class="flex justify-between">
                                    <p>Order On</p>
                                    <p>
                                        {{
                                            HumanReadableDate(order.order_date)
                                        }}
                                    </p>
                                </div>
                            </Link>
                        </li>
                        <li class="flex justify-center items-center">
                            <a
                                class="border rounded-full px-4 py-2 w-full text-center font-semibold hover:underline"
                                href="/orders"
                                >Past Orders &rarr;</a
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import TheStar from "@/Components/icons/TheStar.vue";
import { HumanReadableDate } from "@/Utils/DateUtils";
import ButtonSubmit from "@/Components/ButtonSubmit.vue";
import { onMounted, ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { Loader } from "@googlemaps/js-api-loader";
import toast from "@/Stores/toast";

const { user } = defineProps({
    user: Object,
});

const form = useForm({
    street: null,
    city: null,
    state: null,
    zipcode: null,
    country: null,
});

const inputRef = ref(null);

onMounted(() => {
    const loader = new Loader({
        apiKey: import.meta.env.VITE_GOOGLE_MAPS_API_KEY,
        libraries: ["places"],
    });
    const importPlaces = loader.importLibrary("places");
    importPlaces.then(({ Autocomplete }) => {
        const autocomplete = new Autocomplete(inputRef.value, {
            componentRestrictions: { country: ["us", "ca"] },
            fields: ["address_components", "geometry"],
            types: ["address"],
        });
        autocomplete.addListener("place_changed", () => {
            const place = autocomplete.getPlace();
            console.log(place);
            let address1 = "";
            for (const component of place.address_components) {
                const componentType = component.types[0];

                switch (componentType) {
                    case "street_number": {
                        address1 = `${component.long_name} ${address1}`;
                        break;
                    }
                    case "route": {
                        address1 += component.short_name;
                        break;
                    }
                    case "postal_code": {
                        form.zipcode = component.long_name;
                        break;
                    }
                    case "locality":
                        form.city = component.long_name;
                        break;
                    case "administrative_area_level_1": {
                        form.state = component.short_name;
                        break;
                    }
                    case "country":
                        form.country = component.long_name;
                        break;
                }
            }
            form.street = address1;
        });
    });
});

const orders = user.orders;
const submitForm = () => {
    toast.add({
        message: "Address added successfully.",
    });
    form.reset();
};
</script>
