<script setup>
import { onMounted, ref } from 'vue';

// Define the model and options as props
const model = defineModel({
    type: [String, Number],
    required: true,
});

defineProps({
    options: {
        type: Array,
        required: true, // Array of options
    },
});

const select = ref(null);

// Automatically focus if the `autofocus` attribute is present
onMounted(() => {
    if (select.value?.hasAttribute('autofocus')) {
        select.value.focus();
    }
});

// Expose focus method
defineExpose({
    focus: () => select.value.focus(),
});
</script>

<template>
    <select class="select select-bordered w-full" v-model="model" ref="select">
        <option value="" disabled>Select an option</option>
        <option v-for="option in options" :key="option.value" :value="option.value">
            {{ option.label }}
        </option>
    </select>
</template>