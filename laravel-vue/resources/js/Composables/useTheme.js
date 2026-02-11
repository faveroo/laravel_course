
import { ref, onMounted, watch } from 'vue';

const isDark = ref(false);

export function useTheme() {
    function applyTheme() {
        if (isDark.value) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
            console.log('dark removed')
        }
    }

    function toggleTheme() {
        isDark.value = !isDark.value;
        applyTheme();
        localStorage.setItem('theme', isDark.value ? 'dark' : 'light');
    }

    onMounted(() => {
        const saved = localStorage.getItem('theme');
        if (saved) {
            isDark.value = saved === 'dark';
        } else {
            isDark.value = window.matchMedia('(prefers-color-scheme: dark)').matches;
        }
        applyTheme();
    });

    return {
        isDark,
        toggleTheme
    };
}
