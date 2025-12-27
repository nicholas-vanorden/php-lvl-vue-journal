<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    journalEntry: Object,
    allTags: Array,
});

const form = useForm({
    title: props.journalEntry.title,
    content: props.journalEntry.content,
    tags: props.journalEntry.tags.map(tag => tag.name).join(', '),
});

const submit = () => {
    form.put(route('journal.update', props.journalEntry.id));
};
</script>

<template>
    <Head :title="`Edit ${form.title || 'Entry'}`" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Journal Entry</h2>
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
                                    class="mt-1 block w-full bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400"
                                    v-model="form.title"
                                    autocomplete="title"
                                />
                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="content" value="Content" />
                                <textarea
                                    id="content"
                                    class="mt-1 block w-full bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 rounded-md shadow-sm font-handwriting"
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
                                    class="mt-1 block w-full bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400"
                                    v-model="form.tags"
                                    autocomplete="tags"
                                />
                                <InputError class="mt-2" :message="form.errors.tags" />
                            </div>

                            <div class="flex items-center justify-end mt-4 space-x-4">
                                <Link :href="route('journal.index')" class="inline-flex items-center px-4 py-2 bg-gray-300 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-400 dark:hover:bg-gray-500 hover:cursor-pointer focus:bg-gray-400 dark:focus:bg-gray-500 active:bg-gray-500 dark:active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Cancel
                                </Link>
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Update Entry
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

