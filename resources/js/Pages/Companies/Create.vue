
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import FileInput from '@/Components/FileInput.vue';
import Select from '@/Components/Select.vue';
import Editor from '@tinymce/tinymce-vue'
import { Head, useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';
import { ref } from 'vue';

const toast = useToast();

const form = useForm({
    logo: null,
    name: '',
    status: 'Active'
});

const submit = () => {
    form.post(route('companies.store'), {
        onSuccess: () => {
            toast.success('Company added successfully!', { duration: 3000, type: 'success', position: 'top-right' });
        },
        onError: () => {
            toast.error('Failed to add company!', { duration: 3000, type: 'error', position: 'top-right' });
        }
    });
};

</script>

<template>
    <Head title="Create Company" />
    
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Company
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white shadow sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <!-- Logo -->
                        <div class="mb-4">
                            <InputLabel for="logo" value="Logo" />
                            <FileInput
                                label="Upload Logo"
                                v-model="form.logo"
                            />
                            <InputError class="mt-2" :message="form.errors.logo" />
                        </div>

                        <!-- Name -->
                        <div class="mb-4">
                            <InputLabel for="name" value="Name" />
                            <TextInput
                                id="name"
                                type="text"
                                v-model="form.name"
                                class="mt-1 block w-full"
                                
                            />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4 flex items-center justify-end">
                            <PrimaryButton
                                class="ms-4"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Create Company
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>