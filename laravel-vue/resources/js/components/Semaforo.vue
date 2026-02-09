<template>
    <h1> Semáforo </h1>

    <div class="semaforo">
        <div class="luz" :class="{vermelho: estado === 0}"></div> 
        <div class="luz" :class="{verde: estado === 1}"></div> 
        <div class="luz" :class="{amarelo: estado === 2}"></div> 
    </div>

    <p> Estado Atual: {{ estado_desc }} </p>

    <button @click="proximaEstado"> Proximo </button>
    <button @click="anteriorEstado"> Anterior </button>
    <button @click="estado = 0"> Resetar </button>
</template>

<script setup>

import { ref, watch } from 'vue'

const estado = ref(0)
const estado_desc = ref('Vermelho')

watch(() => estado.value, () => {
    if (estado.value === 0) {
        estado_desc.value = 'Vermelho'
    } else if (estado.value === 1) {
        estado_desc.value = 'Verde'
    } else if (estado.value === 2) {
        estado_desc.value = 'Amarelo'
    }
})

const proximaEstado = () => {
    if (estado.value === 2) {
        estado.value = 0
    } else {
        estado.value++
    }
}

const anteriorEstado = () => {
    if (estado.value === 0) {
        estado.value = 2
    } else {
        estado.value--
    }
}

</script>