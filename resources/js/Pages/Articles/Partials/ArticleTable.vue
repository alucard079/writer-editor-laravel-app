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
    <div class="card bg-base-100 shadow-md">
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Link</th>
                        <th>Date</th>
                        <th>Writer</th>
                        <th>Editor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="article in articles" :key="article.id">
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
                        <td>{{ article.title }}</td>
                        <td>
                            <a
                                :href="article.link"
                                target="_blank"
                                class="text-blue-600 underline"
                            >
                                View
                            </a>
                        </td>
                        <td>{{ article.date }}</td>
                        <td>{{ article.writer?.firstname ? article.writer?.firstname + ' ' +  article.writer?.lastname  : 'N/A' }}</td>
                        <td>{{ article.editor?.firstname ? article.editor?.firstname + ' ' +  article.editor?.lastname : 'N/A' }}</td>
                    </tr>
            </tbody>
            </table>
        </div>
    </div>
</template>
