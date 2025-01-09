<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    canEdit: {
        type: Boolean,
        default: false,
    },
    canPublish : {
        type: Boolean,
        default: false,
    },
    articles : {
        type: Array,
    },
});

</script>

<template>
    <table class="min-w-full table-auto border-collapse border border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 border">Image</th>
                <th class="px-4 py-2 border">Title</th>
                <th class="px-4 py-2 border">Link</th>
                <th class="px-4 py-2 border">Date</th>
                <th class="px-4 py-2 border">Writer</th>
                <th class="px-4 py-2 border">Editor</th>
                <!-- <th class="px-4 py-2 border">Actions</th> -->
            </tr>
        </thead>
        <tbody>
            <tr v-for="article in articles" :key="article.id" class="hover:bg-gray-100">
                <td class="px-4 py-2 border">
                    <img
                        :src="article.image_url"
                        alt="Article Image"
                        class="w-16 h-16 object-cover"
                    />
                </td>
                <td class="px-4 py-2 border">{{ article.title }}</td>
                <td class="px-4 py-2 border">
                    <a
                        :href="article.link"
                        target="_blank"
                        class="text-blue-600 underline"
                    >
                        View
                    </a>
                </td>
                <td class="px-4 py-2 border">{{ article.date }}</td>
                <td class="px-4 py-2 border">{{ article.writer?.firstname ? article.writer?.firstname + ' ' +  article.writer?.lastname  : 'N/A' }}</td>
                <td class="px-4 py-2 border">{{ article.editor?.firstname ? article.editor?.firstname + ' ' +  article.editor?.lastname : 'N/A' }}</td>
                <!-- <td class="px-4 py-2 border">
                    <Link
                        v-if="canEdit"
                        class="px-4 py-2 text-sm font-medium bg-green-600 hover:bg-green-700 text-white rounded-md"
                        :href="route('articles.edit', article.id)"
                    >
                        Edit
                    </Link>

                    <form
                        v-if="canPublish"
                        :action="route('articles.publish', article.id)"
                        method="POST"
                        @submit.prevent="publish(article.id)"
                    >
                        <button type="submit" class="text-green-600 underline">
                            Publish
                        </button>
                    </form>
                </td> -->
            </tr>
        </tbody>
    </table>
</template>
