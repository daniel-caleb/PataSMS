<script setup>
import {Head, useForm, usePage, Link} from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectInput from "@/Components/SelectInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import toast from "@/Stores/Toast.js";

defineOptions({
    layout: AppLayout,
})

defineProps({
    roles: {
        type: Object,
        required: true,
    }
})

const form = useForm({
    name: "",
    email: "",
    role: "",
});

const page = usePage()

const handleSubmit = () => {
    form.post('/admin/user/create',{
        preserveScroll: true,
        onError: (errors) => {
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
    <Head title="Create User" />

    <div>
        <div class="grid grid-cols-2">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Create User
            </h2>

            <span class="flex align-center justify-end">
                <Link href="/admin/user">
                     <PrimaryButton class="flex justify-between my-6">
                         <svg class="w-5 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" d="M15 10a.75.75 0 01-.75.75H7.612l2.158 1.96a.75.75 0 11-1.04 1.08l-3.5-3.25a.75.75 0 010-1.08l3.5-3.25a.75.75 0 111.04 1.08L7.612 9.25h6.638A.75.75 0 0115 10z" fill-rule="evenodd"/>
                            </svg>
                            <span class="mx-1">Back</span>
                     </PrimaryButton>
                </Link>
            </span>
        </div>
    </div>

    <div class="space-y-6 mb-6">
        <div class="p-4 sm:p-6 bg-white sm:rounded-md shadow-sm">
            <section>

                <form @submit.prevent="handleSubmit()" class="space-y-6">
                    <div>
                        <InputLabel for="name" value="Name" />

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div>
                        <InputLabel for="email" value="Email" />

                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            autocomplete="username"
                        />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div>
                        <InputLabel for="role" value="Role" />

                        <SelectInput
                            id="role"
                            :class="form.role === '' ? 'text-gray-500' : '' "
                            class="mt-1 block w-full"
                            v-model="form.role"
                            autocomplete="role"
                        >
                            <option value="">select</option>
                            <option v-for="role in roles" :value=role.name>{{ role.name }}</option>
                        </SelectInput>

                        <InputError class="mt-2" :message="form.errors.role" />
                    </div>

                    <div class="flex items-center gap-4">
                        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                        <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                        </Transition>
                    </div>
                </form>
            </section>
        </div>
    </div>
</template>
