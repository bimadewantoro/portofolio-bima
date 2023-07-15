<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';

defineProps({
    projects: {
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
    <Head title="Projects" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Projects</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end m-2 p-2">
                    <Link href="/projects/create" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Add Project
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
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Link
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Skill
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
                        <tr v-for="project in projects.data" :key="project.id" class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ project.id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ project.name }}
                            </td>
                            <td class="px-6 py-4">
                                <img :src="project.image" class="w-12 h-12">
                            </td>
                            <td class="px-6 py-4">
                                <a :href="project.link" target="_blank">{{ project.link }}</a>
                            </td>
                            <td class="px-6 py-4">
                                {{ project.skill.name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ formatDate(project.updated_at) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ formatDate(project.created_at) }}
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
