<script setup>
import Header from '@/Components/Header.vue'
import MainLayout from '@/Layouts/MainLayout.vue'
import { Link } from '@inertiajs/vue3'

defineOptions({
    layout: MainLayout,
})
</script>

<template>
    <Header>Test</Header>
    <p>I'm here to test!</p>
    <Link href="/"> Take me to Home page </Link>
</template>