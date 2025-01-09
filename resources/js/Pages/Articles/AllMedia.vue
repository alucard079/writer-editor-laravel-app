<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

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
                    class="px-4 py-2 text-sm font-medium bg-green-600 hover:bg-green-700 text-white rounded-md"
                    :href="route('articles.index')"
                >
                    Back to Dashboard
                </Link>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    All Media
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <table class="table-auto w-full border-collapse border border-gray-300">
                            <thead>
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                                    <th class="border border-gray-300 px-4 py-2">Image</th>
                                    <th class="border border-gray-300 px-4 py-2">Title</th>
                                    <th class="border border-gray-300 px-4 py-2">Link</th>
                                    <th class="border border-gray-300 px-4 py-2">Writer</th>
                                    <th class="border border-gray-300 px-4 py-2">Editor</th>
                                    <th class="border border-gray-300 px-4 py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="article in articles" :key="article.id">
                                    <!-- Actions -->
                                    <td class="border border-gray-300 px-4 py-2">
                                        <!-- Show edit action only if writer and status is "For Edit" -->
                                        <button
                                            v-if="role === 'writer' && article.status === 'For Edit'"
                                            @click="route('articles.edit', article.id)"
                                            class="px-4 py-2 text-sm font-medium bg-green-600 hover:bg-green-700 text-white rounded-md"
                                        >
                                            Edit
                                        </button>
                                        <!-- Show edit action for editor -->
                                        <button
                                            v-else-if="role === 'editor'"
                                            @click="route('articles.edit', article.id)"
                                            class="px-4 py-2 text-sm font-medium bg-green-600 hover:bg-green-700 text-white rounded-md"
                                        >
                                            Edit
                                        </button>
                                    </td>

                                    <!-- Image -->
                                    <td class="border border-gray-300 px-4 py-2">
                                        <img
                                            :src="article.image_url"
                                            alt="Article Image"
                                            class="h-16 w-16 object-cover rounded-md"
                                        />
                                    </td>

                                    <!-- Title -->
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ article.title }}
                                    </td>

                                    <!-- Link -->
                                    <td class="border border-gray-300 px-4 py-2">
                                        <a
                                            :href="article.link"
                                            target="_blank"
                                            class="text-blue-500 hover:underline"
                                        >
                                            View
                                        </a>
                                    </td>

                                    <!-- Writer -->
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ article.writer?.name || 'N/A' }}
                                    </td>

                                    <!-- Editor -->
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ article.editor?.name || 'N/A' }}
                                    </td>

                                    <!-- Status -->
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ article.status }}
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