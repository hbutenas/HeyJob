import {defineNuxtRouteMiddleware} from "nuxt/app";
import {useAuthStore} from "~/stores/useAuthStore.js";

export default defineNuxtRouteMiddleware(async (to, from) => {
    const auth = useAuthStore();

    if (auth.isLoggedIn) {
        return true;
    }

    return navigateTo('/auth');
});
