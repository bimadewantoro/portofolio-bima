<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';

defineProps({
    educations: {
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
    <Head title="Educations" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Educations</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end m-2 p-2">
                    <Link href="/educations/create" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Add Education
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
                                School
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Degree
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Field
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
                        <tr v-for="education in educations.data" :key="education.id" class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ education.id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ education.school }}
                            </td>
                            <td class="px-6 py-4">
                                {{ education.degree }}
                            </td>
                            <td class="px-6 py-4">
                                {{ education.field }}
                            </td>
                            <td class="px-6 py-4">
                                {{ education.start_date }}
                            </td>
                            <td class="px-6 py-4">
                                {{ education.end_date }}
                            </td>
                            <td class="px-6 py-4">
                                {{ formatDate(education.updated_at) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ formatDate(education.created_at) }}
                            </td>
                            <td class="px-6 py-4">
                                <Link
                                    :href="route('educations.edit', education.id)"
                                    class="font-medium text-blue-500 hover:text-blue-700 mr-2"
                                >Edit</Link>
                                <Link
                                    :href="route('educations.destroy', education.id)"
                                    method="delete"
                                    as="button"
                                    type="button"
                                    class="font-medium text-red-500 hover:text-red-700 mr-2"
                                >Delete</Link>
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
