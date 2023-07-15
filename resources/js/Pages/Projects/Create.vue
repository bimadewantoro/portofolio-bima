<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({
    skills: Array,
})

const form = useForm({
    skill_id: '',
    name: '',
    project_url: '',
    image: '',
});

const submit = () => {
    form.post(route('projects.store'));
};

</script>

<template>
    <Head title="Add Project" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Project</h2>
        </template>

        <div class="py-12">
            <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white">
                <form class="p-4" @submit.prevent="submit">
                    <div>
                        <InputLabel for="skill_id" value="Skills" />
                        <select
                            v-model="form.skill_id"
                            id="skill_id"
                            name="skill_id" class="
                            mt-1
                            block
                            w-full
                            pl-3
                            pr-10
                            py-2
                            text-base
                            rounded-md
                            border-gray-300
                            focus:outline-none
                            focus:ring-indigo-500
                            focus:border-indigo-500
                            sm: text-sm">
                            <option v-for="skill in skills" :key="skill.id" :value="skill.id">{{ skill.name }}</option>
                        </select>
                    </div>
                    <div class="mt-4">
                        <InputLabel for="name" value="Name" />

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Ex. My Project"
                        />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="project_url" value="URL" />

                        <TextInput
                            id="project_url"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.project_url"
                            autocomplete="projecturl"
                            placeholder="Ex. https://myproject.com"
                        />

                        <InputError class="mt-2" :message="form.errors.project_url" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="image" value="Image" />

                        <TextInput
                            id="image"
                            type="file"
                            class="mt-1 block w-full"
                            @input="form.image = $event.target.files[0]"
                        />

                        <InputError class="mt-2" :message="form.errors.image" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" style="background-color: #22C55E;">
                            Store
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
