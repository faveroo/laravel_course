<script setup>
import Navbar from '@/Components/Navbar.vue'
import Sidebar from '@/Components/Sidebar.vue'
import { useTheme } from '@/Composables/useTheme'

const { isDark, toggleTheme } = useTheme()


</script>

<template>
  <div class="min-h-screen bg-gray-50 dark:bg-slate-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">
    <Navbar />
    
    <div class="flex">
      <Sidebar />

      <main class="flex-1 p-6">
          <div class="flex justify-end mb-4">
             <button
              @click="toggleTheme"
              class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
            >
              {{ isDark ? '🌙 Dark Mode' : '☀️ Light Mode' }}
            </button>
          </div>
        <slot />
      </main>
    </div>
  </div>
</template>
