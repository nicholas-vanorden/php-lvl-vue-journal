<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
    content: '',
    tags: '',
});

const submit = () => {
    form.post(route('journal.store'), {
        onSuccess: () => form.reset('title', 'content', 'tags'),
    });
};
</script>

<template>
    <Head title="New Journal Entry" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">New Journal Entry</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="title" value="Title (Optional)" />
                                <TextInput
                                    id="title"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.title"
                                    autocomplete="title"
                                />
                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="content" value="Content" />
                                <textarea
                                    id="content"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    v-model="form.content"
                                    rows="10"
                                ></textarea>
                                <InputError class="mt-2" :message="form.errors.content" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="tags" value="Tags (comma-separated)" />
                                <TextInput
                                    id="tags"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.tags"
                                    autocomplete="tags"
                                />
                                <InputError class="mt-2" :message="form.errors.tags" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Post Entry
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

