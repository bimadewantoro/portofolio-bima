<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';

defineProps({
    experiences: {
        type: Object,
        required: true,
    },
});

const formatDate = (dateTimeString) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric' };
    const dateTime = new Date(dateTimeString);
    return dateTime.toLocaleDateString(undefined, options);
};
</script>

<template>
    <Head title="Experiences" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Experiences</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end m-2 p-2">
                    <Link href="/experiences/create" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Add Experience
                    </Link>
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Start Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                End Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Updated At
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Created At
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="experience in experiences.data" :key="experience.id" class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ experience.id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ experience.title }}
                            </td>
                            <td class="px-6 py-4">
                                <pre class="whitespace-pre-wrap">{{ experience.description }}</pre>
                            </td>
                            <td class="px-6 py-4">
                                <img :src="experience.image" class="max-w-full max-h-full" />
                            </td>
                            <td class="px-6 py-4">
                                {{ experience.start_date }}
                            </td>
                            <td class="px-6 py-4">
                                {{ experience.end_date }}
                            </td>
                            <td class="px-6 py-4">
                                {{ formatDate(experience.updated_at) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ formatDate(experience.created_at) }}
                            </td>
                            <td class="px-6 py-4">
                                Edit/Delete
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
