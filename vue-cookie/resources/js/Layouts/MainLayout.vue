<script setup>
import { ref, onMounted } from 'vue'
import { Link } from '@inertiajs/vue3'


const isDark = ref(false)

onMounted(() => {
  const saved = localStorage.getItem('theme')
  if (saved === 'dark') {
    isDark.value = true
    document.documentElement.classList.add('dark')
  }
})

const toggleTheme = () => {
  isDark.value = !isDark.value

  if (isDark.value) {
    document.documentElement.classList.add('dark')
    localStorage.setItem('theme', 'dark')
  } else {
    document.documentElement.classList.remove('dark')
    localStorage.setItem('theme', 'light')
  }
}
</script>

<template>
  <div class="min-h-screen bg-gray-100 dark:bg-gray-900 transition-colors">

    <!-- HEADER -->
    <header class="flex justify-between items-center p-4 bg-white dark:bg-gray-800 shadow">
      <h1 class="text-lg font-bold text-gray-800 dark:text-white">Meu App</h1>

      <Link
      v-if="$page.url == '/'"
        href="/cookie"
        class="inline-block px-3 py-1 rounded bg-gray-200 dark:bg-gray-700 dark:text-white text-sm hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors cursor-pointer"
      >
        Continuar como visitante
      </Link>

      <button
        @click="toggleTheme"
        class="px-3 py-1 rounded bg-gray-200 dark:bg-gray-700 dark:text-white text-sm cursor-pointer"
      >
        {{ isDark ? '🌙 Dark' : '☀️ Light' }}
      </button>
    </header>

    <!-- CONTEÚDO DAS PÁGINAS -->
    <main class="p-6">
      <slot />
    </main>

  </div>
</template>
