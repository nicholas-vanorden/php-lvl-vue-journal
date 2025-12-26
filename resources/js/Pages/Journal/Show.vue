<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    journalEntry: Object,
});
</script>

<template>
    <Head :title="journalEntry.title || 'Journal Entry'" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ journalEntry.title || 'Untitled Entry' }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                            {{ new Date(journalEntry.created_at).toLocaleString() }}
                        </div>
                        <p class="text-gray-700 dark:text-gray-300 mb-4 font-handwriting">{{ journalEntry.content }}</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span v-for="tag in journalEntry.tags" :key="tag.id" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200">
                                {{ tag.name }}
                            </span>
                        </div>
                        <div class="flex justify-end">
                            <Link :href="route('journal.index')" class="text-sm text-indigo-600 hover:text-indigo-900">Back to Entries</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

