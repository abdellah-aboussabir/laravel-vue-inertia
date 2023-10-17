<script lang="ts" setup>
import {Head, Link} from "@inertiajs/vue3";

defineProps<{
    posts: object;
    title: string;
}>();
</script>

<template>
    <Head :title="title" />
    <div class="flex flex-row justify-center w-screen h-screen">
        <div class="w-full m-20 flex justify-center flex-col items-center">
            <div class="mb-3 w-full flex place-content-between">
                <div class="bg-gradient-to-r from-green-400 to-blue-500 text-transparent bg-clip-text">
                    Listing Posts
                </div>
                <div class="relative">
                    <Link :href="route('post.create')">
                        <span
                            class="rounded p-1 ml-2 bg-blue-200 text-blue-400 hover:border-blue-600 hover:text-blue-600 hover:bg-blue-400">New Post</span>
                    </Link>
                </div>
            </div>
            <div class="w-full overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            title
                        </th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >
                            content
                        </th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >
                            userID
                        </th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="post in posts.data.data">
                        <td class="px-6 py-4 whitespace-no-wrap">
                            {{ post?.title }}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            {{ post?.content }}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            {{ post?.user_id }}
                        </td>
                        <td>
                            <Link :href="route('post.edit',{
                                        'id' : post?.id
                                     })">
                                        <span
                                            class="rounded p-1 ml-2 bg-green-200 text-green-400 hover:border-green-600 hover:text-green-600 hover:bg-green-400"
                                        >E</span
                                        >
                            </Link>
                            <Link :href="route('post.edit',{
                                        'id' : post?.id
                                    })">                                        <span
                                            class="rounded p-1 ml-2 bg-red-200 text-red-400 hover:border-red-600 hover:text-red-600 hover:bg-red-400"
                            >X</span
                                        >
                            </Link>
                            <Link :href="route('post.show',{
                                        'id' : post?.id
                                    })">
                                        <span
                                            class="rounded p-1 ml-2 bg-gray-200 text-gray-400 hover:border-gray-600 hover:text-gray-600 hover:bg-gray-400"
                                        >V</span
                                        >
                            </Link>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<style scoped></style>
