<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm, router} from '@inertiajs/vue3';
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    education: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    school: props.education?.school,
    degree: props.education?.degree,
    field: props.education?.field,
    start_date: props.education?.start_date,
    end_date: props.education?.end_date,
});

const submit = () => {
    router.post(`/educations/${props.education.id}`, {
        _method: 'put',
        school: form.school,
        degree: form.degree,
        field: form.field,
        start_date: form.start_date,
        end_date: form.end_date,
    })
};
</script>

<template>
    <Head title="Edit Educations"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Education</h2>
        </template>

        <div class="py-12">
            <div class="max-w-md mx-auto sm:px-6 lg:px-8 bg-white">
                <form class="p-4" @submit.prevent="submit">
                    <div>
                        <InputLabel for="degree" value="Degree" />

                        <select
                            v-model= "form.degree"
                            id="degree"
                            name="degree" class="
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
                            sm: text-sm"
                        >
                            <option value="high_school">High School</option>
                            <option value="bachelor">Bachelor</option>
                            <option value="master">Master</option>
                            <option value="doctorate">Doctorate</option>
                            <option value="associate">Associate</option>
                        </select>

                        <InputError class="mt-2" :message="form.errors.degree" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="school" value="School" />

                        <TextInput
                            id="school"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.school"
                            required
                            autofocus
                            autocomplete="school"
                            placeholder="Ex. Harvard University"
                        />

                        <InputError class="mt-2" :message="form.errors.school" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="field" value="Field" />

                        <TextInput
                            id="field"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.field"
                            required
                            autofocus
                            autocomplete="field"
                            placeholder="Ex. Computer Science"
                        />

                        <InputError class="mt-2" :message="form.errors.field" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="start_date" value="Start Date" />

                        <TextInput
                            id="start_date"
                            type="date"
                            class="mt-1 block w-full"
                            v-model="form.start_date"
                            required
                            autofocus
                            autocomplete="start_date"
                        />

                        <InputError class="mt-2" :message="form.errors.start_date" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="end_date" value="End Date" />

                        <TextInput
                            id="end_date"
                            type="date"
                            class="mt-1 block w-full"
                            v-model="form.end_date"
                            required
                            autofocus
                            autocomplete="end_date"
                        />

                        <InputError class="mt-2" :message="form.errors.end_date" />
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
