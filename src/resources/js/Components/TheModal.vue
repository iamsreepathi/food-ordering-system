<template>
    <TransitionGroup
        tag="div"
        enter-from-class="-translate-y-full opacity-0"
        enter-active-class="duration-500"
        leave-active-class="duration-500"
        leave-to-class="-translate-y-full opacity-0"
        class="fixed top-4 right-4 z-50 w-full max-w-xs space-y-4"
    >
        <div
            class="fixed inset-0 z-50 flex items-center justify-center bg-opacity-50 bg-black"
            key="modal"
            v-if="isOpen"
        >
            <div
                class="bg-white rounded-lg shadow-lg w-full max-w-md p-4 mx-2 relative"
            >
                <div
                    class="flex justify-between items-center pb-2 border-b border-gray-200"
                >
                    <h3 class="text-lg font-semibold">{{ title }}</h3>
                    <button
                        @click="closeModal"
                        class="text-gray-500 hover:text-gray-700"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="py-4">
                    <slot></slot>
                </div>
                <!-- Modal footer -->
                <div class="flex justify-end space-x-1">
                    <ButtonSubmit
                        @click="closeModal"
                        class="rounded-md"
                        type="button"
                    >
                        Cancel
                    </ButtonSubmit>
                    <ButtonSubmit
                        @click="submitModal"
                        class="rounded-md"
                        type="button"
                    >
                        {{ buttonText }}
                    </ButtonSubmit>
                </div>
            </div>
        </div>
    </TransitionGroup>
</template>
<script setup>
import ButtonSubmit from "@/Components/ButtonSubmit.vue";

const closeEvent = "close";
const submitEvent = "submit";
defineProps({
    buttonText: String,
    isOpen: {
        default: false,
        type: Boolean,
    },
    title: {
        type: String,
        default: "Form Modal",
    },
});
const emit = defineEmits([closeEvent, submitEvent]);

const closeModal = () => {
    emit(closeEvent);
};

const submitModal = () => {
    emit(submitEvent);
};
</script>
