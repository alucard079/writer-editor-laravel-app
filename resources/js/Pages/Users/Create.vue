<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Select from '@/Components/Select.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useToast } from 'vue-toast-notification';
import InputError from '@/Components/InputError.vue';

const toast = useToast();

const form = useForm({
    firstname: '',
    lastname: '',
    email: '',
    role: '',
    status: 'Active',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('users.store'), {
        onSuccess: () => {
            toast.success('User added successfully!', { duration: 3000, type: 'success', position: 'top-right' });
        },
        onError: () => {
            toast.error('Failed to add user!', { duration: 3000, type: 'error', position: 'top-right' });
        }
    });
};
</script>

<template>
    <Head title="Create User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create User
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

                        <!-- Password -->
                        <div class="mb-4">
                            <InputLabel for="password" value="Password" />
                            <TextInput
                                id="password"
                                type="password"
                                v-model="form.password"
                                class="mt-1 block w-full"
                            />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <InputLabel for="password_confirmation" value="Confirm Password" />
                            <TextInput
                                id="password_confirmation"
                                type="password"
                                v-model="form.password_confirmation"
                                class="mt-1 block w-full"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.password_confirmation"
                            />
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Create User
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>