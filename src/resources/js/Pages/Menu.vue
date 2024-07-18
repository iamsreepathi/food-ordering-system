<template>
    <AppLayout>
        <section class="space-y-6">
            <SectionTitle>Our Food Menu</SectionTitle>
            <MenuSwiper
                @updateCategory="onCategoryClick"
                :items="categories"
                :categoryId="menuCategory.id"
            />
        </section>
        <section class="pt-4 space-y-4">
            <SectionTitle>{{ menuCategory.name }}</SectionTitle>
            <ul class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <CardItem
                    v-for="item in menuCategory.items"
                    :key="item.id"
                    :item="item"
                />
            </ul>
        </section>
    </AppLayout>
</template>

<script setup>
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionTitle from "@/Components/SectionTitle.vue";
import MenuSwiper from "@/Components/MenuSwiper.vue";
import CardItem from "@/Components/CardItem.vue";

const props = defineProps({
    categories: Array,
    category: Object,
});

const menuCategory = ref(props.category);

const onCategoryClick = (cat) => {
    menuCategory.value = cat;
};
</script>
