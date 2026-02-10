<script setup>
import Navbar from '@/Components/Navbar.vue'
import Sidebar from '@/Components/Sidebar.vue'
</script>

<template>
  <div>
    <Navbar />

    <div class="flex">
      <Sidebar />

      <main class="flex-1 p-6">
        <slot />
      </main>
    </div>
  </div>
</template>
