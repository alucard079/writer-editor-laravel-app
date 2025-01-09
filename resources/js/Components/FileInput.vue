<script setup>
import { ref } from 'vue';
import { defineModel, defineExpose } from 'vue';

const model = defineModel({
    type: [File, null],
    required: true,
});

const inputRef = ref(null);

// Expose a focus method
defineExpose({
    focus: () => inputRef.value?.focus(),
});

// Event handler for file selection
const handleFileChange = (event) => {
    model.value = event.target.files[0];
};
</script>

<template>
    <div class="form-control w-full">
        <label class="label">
            <span class="label-text">{{ $attrs.label || 'Choose a file' }}</span>
        </label>
        <input
            type="file"
            ref="inputRef"
            class="file-input file-input-bordered w-full"
            @change="handleFileChange"
            v-bind="$attrs"
        />
        <span v-if="model && model.name" class="mt-1 text-sm text-gray-600">
            Selected file: {{ model.name }}
        </span>
    </div>
</template>