<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'
import { useForm } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'
import { computed, watch, ref } from 'vue'

defineOptions({
    layout: MainLayout,
})

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  remember: false,
})

const page = usePage()
const successMessage = computed(() => page.props.flash?.success)

const submit = () => {
  form.post('/users', {
    onSuccess: () => {
      form.reset()
    }
  })
}

const showFlash = ref(true)


watch(
  () => page.props.flash,
  () => {
    if (page.props.flash?.success) {
      showFlash.value = true
      setTimeout(() => {
        showFlash.value = false
      }, 3000)
    }
  }
)


</script>

<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 transition-colors">



    <form
      @submit.prevent="submit"
      class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8 w-80 space-y-5"
    >
      <h1 class="text-2xl font-bold text-center text-gray-800 dark:text-gray-100">
        Criar conta
      </h1>

      <!-- Nome -->
      <div>
        <input
          v-model="form.name"
          placeholder="Nome"
          class="w-full p-2 rounded border transition
                 bg-gray-50 dark:bg-gray-700
                 text-gray-800 dark:text-white
                 focus:outline-none focus:ring-2 focus:ring-blue-500
                 placeholder-gray-400 dark:placeholder-gray-300"
          :class="form.errors.name
            ? 'border-red-500 focus:ring-red-500'
            : 'border-gray-300 dark:border-gray-600'"
        />
        <p v-if="form.errors.name" class="text-sm text-red-500 mt-1">
          {{ form.errors.name }}
        </p>
      </div>

      <!-- Email -->
      <div>
        <input
          v-model="form.email"
          placeholder="Email"
          type="email"
          class="w-full p-2 rounded border transition
                 bg-gray-50 dark:bg-gray-700
                 text-gray-800 dark:text-white
                 focus:outline-none focus:ring-2 focus:ring-blue-500
                 placeholder-gray-400 dark:placeholder-gray-300"
          :class="form.errors.email
            ? 'border-red-500 focus:ring-red-500'
            : 'border-gray-300 dark:border-gray-600'"
        />
        <p v-if="form.errors.email" class="text-sm text-red-500 mt-1">
          {{ form.errors.email }}
        </p>
      </div>

      <div>
        <input
            v-model="form.password" 
            type="password"
            placeholder="Senha"
            class="w-full p-2 rounded border transition
                 bg-gray-50 dark:bg-gray-700
                 text-gray-800 dark:text-white
                 focus:outline-none focus:ring-2 focus:ring-blue-500
                 placeholder-gray-400 dark:placeholder-gray-300"
          :class="form.errors.password
            ? 'border-red-500 focus:ring-red-500'
            : 'border-gray-300 dark:border-gray-600'"
            >
            <p v-if="form.errors.password" class="text-sm text-red-500 mt-1">
              {{ form.errors.password }}
            </p>
      </div>

      <div>
        <input
            v-model="form.password_confirmation" 
            type="password"
            placeholder="Confirmar senha"
            class="w-full p-2 rounded border transition
                 bg-gray-50 dark:bg-gray-700
                 text-gray-800 dark:text-white
                 focus:outline-none focus:ring-2 focus:ring-blue-500
                 placeholder-gray-400 dark:placeholder-gray-300"
          :class="form.errors.password_confirmation
            ? 'border-red-500 focus:ring-red-500'
            : 'border-gray-300 dark:border-gray-600'"
            >
            <p v-if="form.errors.password_confirmation" class="text-sm text-red-500 mt-1">
              {{ form.errors.password_confirmation }}
            </p>
      </div>

      <div>
        <input
            v-model="form.remember" 
            type="checkbox"
            class="w-4 h-4"
          :class="form.errors.remember
            ? 'border-red-500 focus:ring-red-500'
            : 'border-gray-300 dark:border-gray-600'"
            >
            <label for="remember" class="text-gray-800 dark:text-white ml-2">Lembrar-me</label>
      </div>

      <!-- Botão -->
      <button
        :disabled="form.processing"
        class="w-full p-2 rounded font-semibold transition
               bg-blue-600 hover:bg-blue-700
               disabled:opacity-50 disabled:cursor-not-allowed
               text-white"
      >
        {{ form.processing ? 'Enviando...' : 'Salvar' }}
      </button>

      <!-- Sucesso -->
      <div v-if="successMessage && showFlash" class="text-green-600 dark:text-green-400 text-sm text-center font-medium">
        {{ successMessage }}
      </div>
    </form>
  </div>
</template>
