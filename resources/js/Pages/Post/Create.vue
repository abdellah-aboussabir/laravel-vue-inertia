<script setup lang="ts">
import {Head, useForm} from "@inertiajs/vue3";


defineProps<{
    title: string
}>()

const form = useForm({
    title: '',
    content: '',
});

</script>

<template>
    <Head :title="title"/>
    <div class="flex justify-center items-center h-screen">
        <div class="w-full max-w-md mx-auto">
            <form @submit.prevent="">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Title
                    </label>
                    <input
                        v-model="form.title"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="name"
                        type="text"
                        placeholder="Enter title"
                    />
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="content">
                        Content
                    </label>
                    <input
                        v-model="form.content"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="content"
                        type="text"
                        placeholder="Enter content"
                    />
                </div>

                <!-- Add more form fields as needed -->

                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit"
                    >
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

</template>

