<script setup>
import MainLayout from '@/Layouts/MainLayout.vue'
import { ref, onMounted, watch, computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

defineOptions({ layout: MainLayout })

const page = usePage()

const cookieValue = ref(page.props.cookieValue ?? 0)
const rebirthBonus = ref(1)
const rebirthQtd = ref(0)
const prestigePoints = ref(0)

// clique base
const cookiesPerClick = ref(1)

const isHolding = ref(false)
let holdInterval = null

// Base dos upgrades (fixo)
const baseUpgrades = [
  { id: 1, nome: 'Cursor', precoBase: 10, bonus: 1 },
  { id: 2, nome: 'Vovó Programadora', precoBase: 50, bonus: 5 },
  { id: 3, nome: 'Fábrica de Cookies', precoBase: 200, bonus: 20 },
  { id: 4, nome: 'Fazenda de Cookies', precoBase: 500, bonus: 50 },
]

const upgrades = ref(criarUpgrades())

function criarUpgrades() {
  return [
    ...baseUpgrades.map(u => ({
      ...u,
      preco: u.precoBase,
      quantidade: 0,
    })),
    getRebirthUpgrade(),
  ]
}

// Rebirth dinâmico
function getRebirthUpgrade() {
  const difficultyMultiplier = 1 + (rebirthQtd.value * 0.1) // 10% mais difícil por rebirth
  const preco = Math.floor(50000 * rebirthBonus.value * difficultyMultiplier)
  
  return {
    id: 999,
    nome: 'Rebirth',
    preco: preco,
    bonus: rebirthBonus.value,
    quantidade: rebirthQtd.value,
    rebirth: true,
  }
}


const specialUpgrades = ref([
  {
    id: 'holdClick',
    nome: 'No More Clicks',
    preco: 100000,
    descricao: 'Segurar o botão gera cookies automaticamente',
    ativo: false,
  }
])

// Prestige Shop
const availablePrestigeUpgrades = [
    {
        id: 'divine_discount',
        nome: 'Desconto Divino',
        basePrice: 1,
        descricao: 'Reduz o custo dos upgrades em 2% por nível.',
        maxLevel: 10,
    },
    {
        id: 'cosmic_click',
        nome: 'Clique Cósmico',
        basePrice: 2,
        descricao: '+1 de base por clique a cada nível.',
        maxLevel: 50,
    },
    {
        id: 'time_warp',
        nome: 'Dobra Temporal',
        basePrice: 5,
        descricao: 'Começa com 5% dos cookies anteriores após Rebirth (max 50%).',
        maxLevel: 10,
    }
]

const prestigeUpgradesState = ref({}) 

const getPrestigeLevel = (id) => prestigeUpgradesState.value[id] || 0


// Clique
const incrementCookie = () => {
  let clickValue = cookiesPerClick.value
  const cosmicLevel = getPrestigeLevel('cosmic_click')
  clickValue += cosmicLevel

  cookieValue.value += clickValue * rebirthBonus.value
}

// Comprar Normal
const comprarUpgrade = (item) => {
  const discountLevel = getPrestigeLevel('divine_discount')
  const discount = 1 - (discountLevel * 0.02) // 2% per level
  
  const cost = item.rebirth ? item.preco : Math.floor(item.preco * discount)
  
  if (cookieValue.value < cost) return

  cookieValue.value -= cost

  // REBIRTH
  if (item.rebirth) {
    const earnedPrestige = 1
    prestigePoints.value += earnedPrestige

    rebirthBonus.value *= 2
    rebirthQtd.value++
    
    const timeWarpLevel = getPrestigeLevel('time_warp')
    const startCookies = Math.floor(item.preco * (timeWarpLevel * 0.05)) 
    
    cookieValue.value = startCookies 
    cookiesPerClick.value = 1
    upgrades.value = criarUpgrades()
    
    return
  }

  // upgrade normal
  item.quantidade++
  cookiesPerClick.value += item.bonus

  const difficultyScaling = 0.01 * rebirthQtd.value 
  const scaling = 1.15 + difficultyScaling

  item.preco = Math.floor(item.preco * scaling)
}

// Comprar Prestige
const comprarPrestige = (item) => {
    const currentLevel = getPrestigeLevel(item.id)
    if (currentLevel >= item.maxLevel) return

    const price = item.basePrice * (currentLevel + 1)
    if (prestigePoints.value < price) return

    prestigePoints.value -= price

    prestigeUpgradesState.value = {
        ...prestigeUpgradesState.value,
        [item.id]: currentLevel + 1
    }
}


function comprarEspecial(item) {
  if (cookieValue.value < item.preco || item.ativo) return

  cookieValue.value -= item.preco
  item.ativo = true
}

function startHold() {
  if (!specialUpgrades.value[0].ativo) return

  isHolding.value = true
  holdInterval = setInterval(() => {
    const cosmicLevel = getPrestigeLevel('cosmic_click')
    const totalClick = (cookiesPerClick.value + cosmicLevel) * rebirthBonus.value
    
    cookieValue.value += totalClick
  }, 100) // 10x por segundo
}

function stopHold() {
  isHolding.value = false
  clearInterval(holdInterval)
}


function saveGame() {
    const data = {
        cookieValue: cookieValue.value,
        rebirthBonus: rebirthBonus.value,
        rebirthQtd: rebirthQtd.value,
        prestigePoints: prestigePoints.value,
        prestigeUpgradesState: prestigeUpgradesState.value,
        cookiesPerClick: cookiesPerClick.value,
        upgrades: upgrades.value,
        specialUpgrades: specialUpgrades.value,
    }

    localStorage.setItem('gameData', JSON.stringify(data))
}

function loadGame() {
    const data = JSON.parse(localStorage.getItem('gameData'))
    if (data) {
        cookieValue.value = data.cookieValue
        rebirthBonus.value = data.rebirthBonus
        rebirthQtd.value = data.rebirthQtd || 0
        prestigePoints.value = data.prestigePoints || 0
        prestigeUpgradesState.value = data.prestigeUpgradesState || {}
        cookiesPerClick.value = data.cookiesPerClick
        upgrades.value = data.upgrades
        
        if (data.specialUpgrades) {
             specialUpgrades.value = specialUpgrades.value.map(base => {
                 const saved = data.specialUpgrades.find(s => s.id === base.id)
                 return saved ? saved : base
             })
        }
    }
}

// salvar jogo
watch(
  [cookieValue, cookiesPerClick, rebirthBonus, upgrades, prestigePoints, prestigeUpgradesState],
  saveGame,
  { deep: true }
)

// carregar jogo
onMounted(() => {
    loadGame()
})

// Computeds for UI
const prestigeShopVisible = computed(() => rebirthQtd.value > 0 || prestigePoints.value > 0)

</script>

<template>
  <div class="flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-900 transition-colors min-h-screen pb-10">
    
    <!-- HEADER / STATUS -->
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8 w-80 space-y-5 mt-10">
      <h1 class="text-2xl font-bold text-center text-gray-800 dark:text-white">
        <button
          class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full shadow-md active:scale-95 transition-transform"
          @click="incrementCookie"
          @mousedown="startHold"
          @mouseup="stopHold"
          @mouseleave="stopHold"
        >
          Cookie 🍪
        </button>
      </h1>

      <p class="text-gray-800 dark:text-white text-center text-3xl font-bold bg-gray-200 dark:bg-gray-700 rounded-full py-2">
        {{ Math.floor(cookieValue) }}
      </p>

      <div class="grid grid-cols-2 gap-2 text-sm text-gray-600 dark:text-gray-300">
          <div class="text-center">
              <span class="block font-bold">Por clique</span>
              {{ (cookiesPerClick + getPrestigeLevel('cosmic_click')) * rebirthBonus }}
          </div>
           <div class="text-center">
              <span class="block font-bold text-purple-500">Rebirth Bonus</span>
              x{{ rebirthBonus }}
          </div>
      </div>
      
      <div v-if="prestigePoints > 0" class="text-center text-yellow-500 font-bold border-t pt-2 border-gray-200 dark:border-gray-600">
          👑 Prestige Points: {{ prestigePoints }}
      </div>
    </div>

    <!-- 🌟 PRESTIGE SHOP -->
    <div v-if="prestigeShopVisible" class="mt-8 max-w-md w-full bg-gradient-to-br from-yellow-50 to-orange-50 dark:from-gray-800 dark:to-gray-900 border-2 border-yellow-400 p-6 rounded-xl shadow-lg relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-yellow-300 via-yellow-500 to-yellow-300"></div>
        <h2 class="text-xl font-black mb-4 text-yellow-700 dark:text-yellow-400 flex items-center gap-2">
            👑 Loja de Prestígio
        </h2>
        
        <ul class="space-y-3">
             <li
                v-for="item in availablePrestigeUpgrades"
                :key="item.id"
                class="flex flex-col bg-white dark:bg-gray-800 p-3 rounded-lg border border-yellow-200 dark:border-yellow-900 shadow-sm"
            >
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <p class="font-bold text-gray-800 dark:text-white">
                            {{ item.nome }} <span class="text-xs text-gray-500">(Nível {{ getPrestigeLevel(item.id) }}/{{ item.maxLevel }})</span>
                        </p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">{{ item.descricao }}</p>
                    </div>
                    <div class="text-right">
                         <p class="text-sm text-yellow-600 font-bold">
                            👑 {{ item.basePrice * (getPrestigeLevel(item.id) + 1) }}
                        </p>
                    </div>
                </div>
                
                 <button
                  @click="comprarPrestige(item)"
                  :disabled="prestigePoints < (item.basePrice * (getPrestigeLevel(item.id) + 1)) || getPrestigeLevel(item.id) >= item.maxLevel"
                  class="w-full px-3 py-1 rounded text-sm font-semibold transition
                         bg-yellow-500 hover:bg-yellow-600 text-white
                         disabled:bg-gray-300 dark:disabled:bg-gray-700 disabled:cursor-not-allowed"
                >
                  {{ getPrestigeLevel(item.id) >= item.maxLevel ? 'MAX' : 'Evoluir' }}
                </button>
            </li>
        </ul>
    </div>

    <!-- 🛒 LOJA DE UPGRADES -->
    <div class="mt-8 max-w-md w-full bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
      <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">🛒 Loja de Upgrades</h2>

      <ul class="space-y-3">
        <li
          v-for="item in upgrades"
          :key="item.id"
          class="flex justify-between items-center bg-gray-100 dark:bg-gray-700 p-3 rounded-lg"
          :class="{ 'border-2 border-purple-500': item.rebirth }"
        >
          <div>
            <p class="font-semibold text-gray-800 dark:text-white">
              {{ item.nome }} <span v-if="!item.rebirth">({{ item.quantidade }})</span>
            </p>

            <p v-if="!item.rebirth" class="text-sm text-gray-600 dark:text-gray-300">
              +{{ item.bonus }} por clique
            </p>

            <p v-else class="text-sm text-purple-500 font-bold">
              +10% Dificuldade 😈 | Dobra Bonus 🌌
              <br><span class="text-xs text-gray-500 dark:text-gray-400">Reseta cookies e upgrades!</span>
            </p>

            <p class="text-sm text-yellow-600 font-bold">
              💰 {{ item.rebirth ? item.preco : Math.floor(item.preco * (1 - getPrestigeLevel('divine_discount') * 0.02)) }}
               <span v-if="!item.rebirth && getPrestigeLevel('divine_discount') > 0" class="text-xs text-gray-400 line-through ml-1">{{ item.preco }}</span>
            </p>
          </div>

          <button
            @click="comprarUpgrade(item)"
            :disabled="cookieValue < (item.rebirth ? item.preco : Math.floor(item.preco * (1 - getPrestigeLevel('divine_discount') * 0.02)))"
            class="px-3 py-1 rounded text-sm font-semibold transition
                   text-white
                   disabled:bg-gray-400 disabled:cursor-not-allowed"
             :class="item.rebirth ? 'bg-purple-600 hover:bg-purple-700' : 'bg-green-500 hover:bg-green-600'"
          >
            Comprar
          </button>
        </li>
      </ul>
    </div>
    
    <!-- 🌟 UPGRADES ESPECIAIS (SIDEBAR) -->
    <div class="fixed right-5 top-5 bottom-5 w-64 bg-gray-900 text-white p-5 shadow-2xl rounded-xl hidden xl:block overflow-y-auto">
      <h2 class="text-xl font-bold mb-4">🌟 Especiais</h2>

      <div
        v-for="item in specialUpgrades"
        :key="item.id"
        class="mb-4 p-3 bg-gray-800 rounded-lg border border-gray-700"
      >
        <p class="font-bold">{{ item.nome }}</p>
        <p class="text-sm text-gray-400 mb-2">{{ item.descricao }}</p>
        <p class="text-yellow-400 font-bold">💰 {{ item.preco }}</p>

        <button
          @click="comprarEspecial(item)"
          :disabled="cookieValue < item.preco || item.ativo"
          class="mt-2 w-full py-1 rounded bg-purple-600 hover:bg-purple-700 disabled:bg-gray-600 dark:disabled:bg-gray-700 transition"
        >
          {{ item.ativo ? 'Comprado' : 'Comprar' }}
        </button>
      </div>
    </div>

  </div>
</template>
