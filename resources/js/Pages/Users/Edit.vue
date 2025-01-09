<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Select from '@/Components/Select.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import { useToast } from 'vue-toast-notification';

const toast = useToast();

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});

const { user } = props;

const form = useForm({
    firstname: user.firstname,
    lastname: user.lastname,
    email: user.email,
    role: user.role.name,
    status: user.status || 'Active',
});

const submit = () => {
    form.put(route('users.update', user.id), {
        onSuccess: () => {
            toast.success('User updated successfully!', { duration: 3000, type: 'success', position: 'top-right' });
        },
        onError: () => {
            toast.error('Failed to update user!', { duration: 3000, type: 'error', position: 'top-right' });
        }
    });
};
</script>

<template>
    <Head title="Edit User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit User
            </h2>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white shadow sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <!-- First Name -->
                        <div class="mb-4">
                            <InputLabel for="firstname" value="First Name" />
                            <TextInput
                                id="firstname"
                                type="text"
                                v-model="form.firstname"
                                class="mt-1 block w-full"
                            />
                            <InputError class="mt-2" :message="form.errors.firstname" />
                        </div>

                        <!-- Last Name -->
                        <div class="mb-4">
                            <InputLabel for="lastname" value="Last Name" />
                            <TextInput
                                id="lastname"
                                type="text"
                                v-model="form.lastname"
                                class="mt-1 block w-full"
                            />
                            <InputError class="mt-2" :message="form.errors.lastname" />
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                type="email"
                                v-model="form.email"
                                class="mt-1 block w-full"
                                readonly
                            />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <!-- Role -->
                        <div class="mb-4">
                            <InputLabel for="role" value="Role" />
                            <Select
                                id="role"
                                v-model="form.role"
                                :options="[
                                    { value: 'writer', label: 'Writer' },
                                    { value: 'editor', label: 'Editor' },
                                ]"
                                class="mt-1 block w-full"
                            />
                            <InputError class="mt-2" :message="form.errors.role" />
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <InputLabel for="status" value="Status" />
                            <Select
                                id="status"
                                v-model="form.status"
                                :options="[
                                    { value: 'Active', label: 'Active' },
                                    { value: 'Inactive', label: 'Inactive' },
                                ]"
                                class="mt-1 block w-full"
                            />
                            <InputError class="mt-2" :message="form.errors.status" />
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Update User
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>