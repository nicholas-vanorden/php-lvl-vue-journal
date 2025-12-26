<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    journalEntries: Array,
    allTags: Array,
    selectedTag: String,
});

const filterTag = ref(props.selectedTag || '');

watch(filterTag, (newTag) => {
    router.get(route('journal.index'), { tag: newTag || undefined }, {
        preserveState: true,
        replace: true,
    });
});

const deleteEntry = (id) => {
    if (confirm('Are you sure you want to delete this journal entry?')) {
        router.delete(route('journal.destroy', id));
    }
};
</script>

<template>
    <Head title="Journal Entries" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Journal Entries</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <Link :href="route('journal.create')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                New Entry
                            </Link>
                            <div class="relative">
                                <select v-model="filterTag" class="block appearance-none w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white dark:focus:bg-gray-700 focus:border-gray-500 dark:focus:border-gray-500">
                                    <option value="">All Tags</option>
                                    <option v-for="tag in allTags" :key="tag.id" :value="tag.name">{{ tag.name }}</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>

                        <div v-if="journalEntries.length === 0" class="text-center text-gray-600 dark:text-gray-400">
                            No journal entries found.
                        </div>

                        <div v-else>
                            <div v-for="entry in journalEntries" :key="entry.id" class="mb-6 p-4 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm bg-white dark:bg-gray-800">
                                <div class="flex justify-between items-center mb-2">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ entry.title || 'Untitled Entry' }}</h3>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ new Date(entry.created_at).toLocaleDateString() }}</span>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300 mb-2">{{ entry.content.substring(0, 200) }}<span v-if="entry.content.length > 200">...</span></p>
                                <div class="flex flex-wrap gap-2 mb-2">
                                    <span v-for="tag in entry.tags" :key="tag.id" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200">
                                        {{ tag.name }}
                                    </span>
                                </div>
                                <div class="flex justify-end gap-2">
                                    <Link :href="route('journal.show', entry.id)" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">View</Link>
                                    <Link :href="route('journal.edit', entry.id)" class="text-sm text-yellow-600 dark:text-yellow-400 hover:text-yellow-900 dark:hover:text-yellow-300">Edit</Link>
                                    <button @click="deleteEntry(entry.id)" class="text-sm text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

