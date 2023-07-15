<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, router, useForm} from '@inertiajs/vue3';
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    experience: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    title: props.experience?.title,
    description: props.experience?.description,
    image: null,
    start_date: props.experience?.start_date,
    end_date: props.experience?.end_date,
});

const submit = () => {
    router.post(`/experiences/${props.experience.id}`, {
        _method: 'put',
        title: form.title,
        description: form.description,
        image: form.image,
        start_date: form.start_date,
        end_date: form.end_date,
    })
};
</script>

<template>
    <Head title="Add Experience" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Experience</h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-8 lg:px-10 bg-white">
                <form class="p-4" @submit.prevent="submit">

                    <div>
                        <InputLabel for="title" value="Title" />

                        <TextInput
                            id="title"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.title"
                            required
                            autofocus
                            autocomplete="title"
                            placeholder="Ex. Backend Developer at Google"
                        />

                        <InputError class="mt-2" :message="form.errors.title" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="description" value="Description" />

                        <textarea
                            id="description"
                            class="mt-1 block w-full h-32 resize-y"
                            v-model="form.description"
                            required
                            autofocus
                            autocomplete="description"
                            placeholder="Ex. - Developed and maintained the backend of the Google search engine."
                        ></textarea>

                        <InputError class="mt-2" :message="form.errors.description" />
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
