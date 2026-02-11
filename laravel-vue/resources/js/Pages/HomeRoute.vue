<script setup>

import Header from '@/Components/Header.vue'
import MainLayout from '@/Layouts/MainLayout.vue'

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
    <div>
        <Header>Home</Header>
        <router-link to="/test"> Take me to Test page </router-link>
        <button
            class="bg-gray-800 dark:bg-gray-600 hover:bg-gray-700 dark:hover:bg-gray-500 text-white px-4 py-2 disabled:opacity-50 cursor-pointer"
            :disabled="loading"
            @click="tiggerEndpoint"
        >
            {{ loading ? 'Gerando...' : 'Gerar Email' }}
        </button>

        <p v-if="response">{{ response }}</p>
    </div>
</template>


