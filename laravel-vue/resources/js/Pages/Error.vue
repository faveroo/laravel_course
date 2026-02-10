<script setup>
import { computed } from 'vue'

const props = defineProps({
  status: Number,
  message: String,
})

const title = computed(() => {
  return {
    503: 'Service Unavailable',
    500: 'Server Error',
    404: 'Page Not Found',
    403: 'Forbidden',
  }[props.status]
})

const description = computed(() => {
  return {
    503: 'Sorry, we are doing some maintenance. Please check back soon.',
    500: 'Whoops, something went wrong on our servers.',
    404: 'Sorry, the page you are looking for could not be found.',
    403: 'Sorry, you are forbidden from accessing this page.',
  }[props.status]
})
</script>

<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100 text-gray-900">
    <div class="p-8 bg-white rounded-lg shadow-xl text-center max-w-lg w-full">
      <h1 class="text-6xl font-bold text-red-500 mb-4">{{ status }}</h1>
      <h2 class="text-2xl font-semibold mb-2">{{ message || title }}</h2>
      <p class="text-gray-600 mb-6">{{ description }}</p>
      <a href="/" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-200">
        Go Home
      </a>
    </div>
  </div>
</template>
