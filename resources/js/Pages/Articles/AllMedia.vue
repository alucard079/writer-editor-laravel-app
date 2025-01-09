<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Link from '@/Components/Link.vue';
import EditIcon from '@/Icons/EditIcon.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps({
    articles: Array,
    role: String,
});
</script>

<template>
    <Head title="All Media" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex gap-2 items-center">
                <Link
                    href="articles.index"
                >
                    BACK TO DASHBOARD
                </Link>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    All Media
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="card bg-base-100 shadow-md">
                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Link</th>
                                    <th>Writer</th>
                                    <th>Editor</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="article in articles" :key="article.id">
                                    <!-- Image -->
                                    <td>
                                        <div class="avatar">
                                            <div class="mask mask-squircle h-12 w-12">
                                                <img
                                                    :src="article.image"
                                                    alt="Article Image"
                                                />
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Title -->
                                    <td>{{ article.title }}</td>

                                    <!-- Link -->
                                    <td>
                                        <a
                                            :href="article.link"
                                            target="_blank"
                                            class="text-blue-600 underline"
                                        >
                                            View
                                        </a>
                                    </td>

                                    <!-- Writer -->
                                    <td>
                                        {{ article.writer?.firstname ? article.writer?.firstname + ' ' + article.writer?.lastname : 'N/A' }}
                                    </td>

                                    <!-- Editor -->
                                    <td>
                                        {{ article.editor?.firstname ? article.editor?.firstname + ' ' + article.editor?.lastname : 'N/A' }}
                                    </td>

                                    <!-- Status -->
                                    <td>{{ article.status }}</td>

                                    <!-- Actions -->
                                    <td>
                                        <!-- Show edit action only if writer and status is "For Edit" -->
                                        <div v-if="role === 'writer' && article.status === 'For Edit'">
                                            <Link
                                                href="articles.edit"
                                                :params="{ id: article.id }"
                                            >
                                                EDIT
                                            </Link>
                                        </div>
                                        <!-- Show edit action for editor -->
                                        <div v-else-if="role === 'editor'">
                                            <Link
                                                href="articles.edit"
                                                :params="{ id: article.id }"
                                            >
                                                EDIT
                                            </Link>
                                        </div>
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