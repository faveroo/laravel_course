<script setup>

import Header from '@/Components/Header.vue'
import MainLayout from '@/Layouts/MainLayout.vue'
import { Link } from '@inertiajs/vue3'

defineOptions({
    layout: MainLayout,
})

import { ref } from 'vue'
import axios from 'axios'

const response = ref(null)
const loading = ref(false)

let controller = null

const tiggerEndpoint = async () => {
    // Cancela a anterior se ainda estiver rodando
    if (controller) {
        controller.abort()
    }

    controller = new AbortController()

    loading.value = true

    try {
        const { data } = await axios.get('/api/test-me', {
            signal: controller.signal
        })

        response.value = data
    } catch (e) {
        if (e.name !== 'CanceledError') {
            console.error(e)
        }
    } finally {
        loading.value = false
    }
}
</script>


<template>
    <div class="flex flex-col gap-4">
        <Header>Home</Header>
        <Link href="/test" class="text-black dark:text-white text-center p-4 bg-gray-300 dark:bg-gray-800 hover:bg-gray-400 dark:hover:bg-gray-900 hover:text-blue-800 dark:hover:text-blue-600 transition-colors"> Take me to Test page </Link>
        <button
            class="bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-black dark:text-white px-4 py-2 disabled:opacity-50 cursor-pointer"
            :disabled="loading"
            @click="tiggerEndpoint"
        >
            {{ loading ? 'Gerando...' : 'Gerar Email' }}
        </button>

        <p v-if="response">{{ response }}</p>
    </div>
</template>


