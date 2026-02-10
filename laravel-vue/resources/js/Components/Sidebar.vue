<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
    <ul class="space-y-2">
        <li><Link href="/">Home</Link></li>
        <li><Link href="/test">Test</Link></li>
    </ul>
  </aside>
</template>