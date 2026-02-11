<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <aside class="w-64 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border-r border-gray-200 dark:border-gray-700 min-h-screen p-4 transition-colors duration-300">
    <ul class="space-y-2">
      
      <li>
        <Link
          href="/"
          class="block w-full px-2 py-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-blue-400 transition-colors"
          :class="{ 'text-blue-600 dark:text-blue-400 bg-gray-100 dark:bg-gray-700': $page.url === '/' }"
        >
          Home
        </Link>
      </li>

      <li>
        <Link
          href="/test"
          class="block w-full px-2 py-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-blue-400 transition-colors"
          :class="{ 'text-blue-600 dark:text-blue-400 bg-gray-100 dark:bg-gray-700': $page.url === '/test' }"
        >
          Test
        </Link>
      </li>

    </ul>
  </aside>
</template>
