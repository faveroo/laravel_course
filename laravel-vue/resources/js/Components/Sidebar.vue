<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
    <ul class="space-y-2">
      
      <li>
        <Link
          href="/"
          class="block w-full px-2 py-1 rounded hover:text-blue-500 hover:bg-gray-900"
          :class="{ 'text-blue-300 bg-gray-700': $page.url === '/' }"
        >
          Home
        </Link>
      </li>

      <li>
        <Link
          href="/test"
          class="block w-full px-2 py-1 rounded hover:text-blue-500 hover:bg-gray-900"
          :class="{ 'text-blue-300 bg-gray-700': $page.url === '/test' }"
        >
          Test
        </Link>
      </li>

    </ul>
  </aside>
</template>
