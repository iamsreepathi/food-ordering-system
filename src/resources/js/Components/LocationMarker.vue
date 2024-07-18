<template>
    <div
        id="map"
        ref="mapRef"
        style="width: 100%; height: 550px"
        class="border border-gray-200"
    ></div>
</template>

<script setup>
import { Loader } from "@googlemaps/js-api-loader";
import { onMounted, ref } from "vue";

const mapRef = ref(null);

const { coords, address, business } = defineProps({
    coords: Object,
    address: Object,
    business: String,
});

onMounted(() => {
    const loader = new Loader({
        apiKey: import.meta.env.VITE_GOOGLE_MAPS_API_KEY,
    });
    const importMaps = loader.importLibrary("maps");
    const importMarker = loader.importLibrary("marker");
    importMaps.then(({ Map, InfoWindow }) => {
        const map = new Map(mapRef.value, {
            center: coords,
            zoom: 6,
            mapId: "Location",
        });
        const content =
            '<div id="content" class="space-y-2">' +
            '<h1 class="text-lg font-semibold" id="firstHeading" class="firstHeading">Our Location</h1>' +
            '<div id="bodyContent" class="space-y-2">' +
            `<p>${business}</p>` +
            `<p>${address.line}</p>` +
            `<p>${address.city}, ${address.state}</p>` +
            `<p>${address.country}, ${address.zipCode}</p>` +
            "</div>" +
            "</div>";
        const popup = new InfoWindow({
            content,
            maxWidth: 400,
            ariaLabel: "Location",
        });
        importMarker.then(({ AdvancedMarkerElement }) => {
            const marker = new AdvancedMarkerElement({
                map,
                position: coords,
                title: "Business Location",
            });
            marker.addListener("click", () => {
                popup.open({
                    anchor: marker,
                    map,
                });
            });
        });
    });
});
</script>
