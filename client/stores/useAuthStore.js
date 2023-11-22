import { defineStore } from "pinia";

export const useAuthStore = defineStore('auth', () => {

    let user = ref(null)

    const isLoggedIn = computed(() => !!user.value);

    async function fetchUser() {
        const { error, data } = await useApiFetch('/api/v1/auth/user');
        user.value = data.value;
    }

    async function register(credentials) {
        await useApiFetch('/sanctum/csrf-cookie');

        const register = await useApiFetch('/api/v1/auth/register', {
            method: 'POST',
            body: credentials
        });

        await fetchUser();

        return register;
    }

    async function login(credentials) {
        await useApiFetch('/sanctum/csrf-cookie');

        const login = await useApiFetch('/api/v1/auth/login', {
            method: 'POST',
            body: credentials,
        });

        await fetchUser();

        return login;
    }

    async function logout() {
        await useApiFetch('/api/v1/auth/logout', {
            method: 'POST',
        });

        // Set user value to null
        user.value = null;
    };

    return { user, login, register, isLoggedIn, fetchUser, logout }
})
