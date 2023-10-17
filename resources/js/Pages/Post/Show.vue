<script setup lang="ts">
import {Head} from "@inertiajs/vue3";

defineProps<{
    postID: object,
    title: string
}>()
</script>

<template>
    <Head :title="title"/>
    <div class="w-full flex flex-col justify-center items-center mb-20">
        <h1 class="text-5xl">Show details of Post id </h1>
        <strong> ID : {{ postID.original.data.id }}</strong>
        <strong> Title : {{ postID.original.data.title }}</strong>
        <strong> Content : {{ postID.original.data.content }}</strong>
    </div>
</template>

<style scoped>

</style>
