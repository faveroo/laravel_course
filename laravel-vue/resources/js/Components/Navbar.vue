<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <nav class="bg-gray-900 text-white p-4 flex justify-between">
    <span>Meu Sistema</span>
    <div class="space-x-4">
      <Link href="/">Home</Link>
      <Link href="/test">Test</Link>
    </div>
  </nav>
</template>