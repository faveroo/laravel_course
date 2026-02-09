<template>
    <div>
        <h2>HOME</h2>
        <router-link to="/test"> Take me to Test page </router-link>
        <button @click.prevent="tiggerEndpoint">Trigger Endpoint</button>
        <p v-if="response">{{ response.data }}</p>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const response = ref();

const tiggerEndpoint = async () => {
    response.value = await axios.get('/api/test-me');
}
</script>