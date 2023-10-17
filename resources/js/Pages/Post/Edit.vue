<script setup lang="ts">
import {Head} from "@inertiajs/vue3";

defineProps<{
    id: string,
}>()


</script>

<template>
    <Head title="Edit Post"/>
    <h1>Edit Post with id : {{ id }}</h1>
</template>
