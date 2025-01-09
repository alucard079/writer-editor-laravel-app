<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ArticleTable from './Partials/ArticleTable.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    role: {
        type: String,
    },
    articlesForEdit : {
        type: Array,
    },
    publishedArticles : {
        type: Array,
    },
});

</script>

<template>
    <Head title="Articles" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800"
                >
                    Articles
                </h2>
                <Link
                    class="px-4 py-2 text-sm font-medium bg-green-600 hover:bg-green-700 text-white rounded-md"
                    :href="route('articles.create')"
                >
                    Create Article
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Role-Specific Content -->
                <Link
                    class="px-4 py-2 text-sm font-medium bg-green-600 hover:bg-green-700 text-white rounded-md"
                    :href="route('articles.allmedia')"
                >
                    Show all media
                </Link>
                <div v-if="role === 'writer'" class="my-4">
                    <h3 class="text-lg font-bold mb-4">Your Articles (For Edit)</h3>
                    <ArticleTable
                        :articles="articlesForEdit"
                        :can-edit="true"
                    />
                </div>

                <div v-if="role === 'editor'" class="my-4">
                    <h3 class="text-lg font-bold mb-4">Articles For Publish</h3>
                    <ArticleTable
                        :articles="articlesForEdit"
                        :can-publish="true"
                    />
                </div>

                <!-- Shared Content: Published Articles -->
                <h3 class="text-lg font-bold mt-8 mb-4">Published Articles</h3>
                <ArticleTable
                    :articles="publishedArticles"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
