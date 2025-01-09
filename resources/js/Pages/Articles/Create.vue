
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ArticleTable from './Partials/ArticleTable.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import FileInput from '@/Components/FileInput.vue';
import Select from '@/Components/Select.vue';
import Editor from '@tinymce/tinymce-vue'
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useToast } from 'vue-toast-notification';

const toast = useToast();

defineProps({
    companies : {
        type: Array,
    },
});

const form = useForm({
    company_id: '',
    image: null,
    title: '',
    link: '',
    date: new Date().toISOString().substr(0, 10),
    content: '',
});

const submit = () => {
    form.post(route('articles.store'), {
        onSuccess: () => {
            toast.success('Article added successfully!', { duration: 3000, type: 'success', position: 'top-right' });
        },
        onError: () => {
            toast.error('Failed to add article!', { duration: 3000, type: 'error', position: 'top-right' });
        }
    });
};

</script>

<template>
    <Head title="Create Article" />
    
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Article
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="bg-white shadow sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <!-- Company -->
                        <div class="mb-4">
                            <InputLabel for="company_id" value="Company" />
                            <Select
                                v-model="form.company_id"
                                :options="companies.map(company => ({
                                    value: company.id,
                                    label: company.name,
                                }))"
                                class="mt-1 block w-full"
                                
                            />
                            <InputError class="mt-2" :message="form.errors.company_id" />
                        </div>

                        <!-- Image -->
                        <div class="mb-4">
                            <InputLabel for="image" value="Image" />
                            <FileInput
                                label="Upload Article Image"
                                v-model="form.image"
                                
                            />
                            <InputError class="mt-2" :message="form.errors.image" />
                        </div>

                        <!-- Title -->
                        <div class="mb-4">
                            <InputLabel for="title" value="Title" />
                            <TextInput
                                id="title"
                                type="text"
                                v-model="form.title"
                                class="mt-1 block w-full"
                                
                            />
                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <!-- Link -->
                        <div class="mb-4">
                            <InputLabel for="link" value="Link" />
                            <TextInput
                                id="link"
                                type="url"
                                v-model="form.link"
                                class="mt-1 block w-full"
                                
                            />
                            <InputError class="mt-2" :message="form.errors.link" />
                        </div>

                        <!-- Date -->
                        <div class="mb-4">
                            <InputLabel for="date" value="Date" />
                            <TextInput
                                id="date"
                                type="date"
                                v-model="form.date"
                                class="mt-1 block w-full"
                                
                            />
                            <InputError class="mt-2" :message="form.errors.date" />
                        </div>

                        <!-- Content -->
                        <div class="mb-4">
                            <InputLabel for="content" value="Content" />
                            <!-- <textarea
                                id="content"
                                v-model="form.content"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                rows="5"
                            ></textarea> -->
                            <editor
                                v-model="form.content"
                                api-key="spuq1bav25eoy14y6hn2498o6qnnhgu6hxsl78wm6kuxoqg3"
                                :init="{
                                    height: 500,
                                    menubar: false,
                                    plugins: [
                                    'advlist autolink lists link image charmap print preview anchor',
                                    'searchreplace visualblocks code fullscreen',
                                    'insertdatetime media table paste code help wordcount'
                                    ],
                                    toolbar:
                                    'undo redo | formatselect | bold italic backcolor | \
                                    alignleft aligncenter alignright alignjustify | \
                                    bullist numlist outdent indent | removeformat | help'
                                }"
                                />
                            <InputError class="mt-2" :message="form.errors.content" />
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4 flex items-center justify-end">
                            <PrimaryButton
                                class="ms-4"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Create Article
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>