<script setup>
import {Head, useForm, usePage, Link} from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import toast from "@/Stores/Toast.js";
import TextareaInput from "@/Components/TextareaInput.vue";
import {defineOptions} from "vue";

const page = usePage()

defineOptions({
    layout: AppLayout,
})

const form = useForm({
    name: "",
    description: "",
})

const handleCreateGroup = () => {
    form.post('/group/create', {
        preserveScroll: true,
        onError: () => {
            toast.add({
                type: 'error',
                message: 'something went wrong',
                duration: 5000
            })
        },
    })
}
</script>

<template>
    <Head title="Create Group" />

        <div>
            <div class="grid grid-cols-2">
                <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                    Create Group
                </h2>

                <span class="flex align-center justify-end">
                    <Link href="/group">
                        <PrimaryButton class="flex justify-between my-6">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" d="M15 10a.75.75 0 01-.75.75H7.612l2.158 1.96a.75.75 0 11-1.04 1.08l-3.5-3.25a.75.75 0 010-1.08l3.5-3.25a.75.75 0 111.04 1.08L7.612 9.25h6.638A.75.75 0 0115 10z" fill-rule="evenodd"/>
                            </svg>
                            <span class="mx-1">Back</span>
                        </PrimaryButton>
                    </Link>
                </span>
            </div>
        </div>

        <div class="bg-white rounded-md p-6">

            <form @submit.prevent="handleCreateGroup()">


                <div>
                    <InputLabel for="name" value="Name" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="description" value="Description" />

                    <TextareaInput
                        id="description"
                        class="mt-1 block w-full"
                        v-model="form.description"
                        autocomplete="description"
                        rows="3"
                    ></TextareaInput>

                    <InputError class="mt-2" :message="form.errors.description" />
                </div>

                <div class="mt-4">
                    <PrimaryButton type="submit">save</PrimaryButton>
                </div>

            </form>
        </div>
</template>
