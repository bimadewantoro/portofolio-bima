<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, router} from '@inertiajs/vue3';

defineProps({
    skills: {
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
    <Head title="Skills" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Skills</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end m-2 p-2">
                    <Link href="/skills/create" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Add Skill
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
                        <tr v-for="skill in skills.data" :key="skill.id" class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ skill.id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ skill.name }}
                            </td>
                            <td class="px-6 py-4">
                                <img :src="skill.image" class="w-12 h-12">
                            </td>
                            <td class="px-6 py-4">
                                {{ formatDate(skill.updated_at) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ formatDate(skill.created_at) }}
                            </td>
                            <td class="px-6 py-4">
                                <Link
                                    :href="route('skills.edit', skill.id)"
                                    class="font-medium text-blue-500 hover:text-blue-700 mr-2"
                                >Edit</Link>
                                <Link
                                    :href="route('skills.destroy', skill.id)"
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
