<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'
import Header from '@/Components/Header.vue'

defineOptions({
    layout: MainLayout,
})

import { ref } from 'vue';
import axios from 'axios';

const response = ref();

const tiggerEndpoint = async () => {
    response.value = await axios.get('/api/test-me');
}
</script>

<template>
    <div>
        <h2>HOME</h2>
        <router-link to="/test"> Take me to Test page </router-link>
        <button class="bg-blue-500 text-white px-4 py-2" @click.prevent="tiggerEndpoint">Trigger Endpoint</button>
        <p v-if="response">{{ response.data }}</p>
    </div>
</template>


