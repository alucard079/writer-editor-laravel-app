<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head } from '@inertiajs/vue3';
import Link from '@/Components/Link.vue';

defineProps({
    companies : {
        type: Array,
    },
});

</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2
                class="text-xl font-semibold leading-tight text-gray-800"
                >
                    Companies
                </h2>
                <Link
                    href="companies.create"
                >
                    CREATE COMPANY
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="card bg-base-100 shadow-md">
                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="company in companies" :key="company.id">
                                    <td>
                                        <div class="avatar">
                                            <div class="mask mask-squircle h-12 w-12">
                                                <img
                                                    :src="company.logo  "
                                                    alt="Logo Image"
                                                />
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ company.name }}</td>
                                    <td>{{ company.status }}</td>
                                    <td>
                                        <Link
                                            href="companies.edit"
                                            :params="{ id: company.id }"
                                        >
                                            Edit
                                        </Link>
                                    </td>
                                </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
