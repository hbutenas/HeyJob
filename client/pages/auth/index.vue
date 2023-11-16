<template>
  <div class="min-h-screen flex items-center justify-center">
    <div class="p-8 rounded-2xl shadow-blue-200 shadow-2xl">
      <div class="flex justify-center space-x-8 mb-6">
        <button @click.prevent="displayAuthComponent('login')"
                :class="displayLoginComponent ? 'text-accent' : 'text-primary'"
                class="text-sm font-semibold tracking-widest">
          Log in
        </button>
        <span class="text-primary">|</span>
        <button @click.prevent="displayAuthComponent('register')"
                :class="displayRegisterComponent ? 'text-accent' : 'text-primary'"
                class="text-sm font-semibold tracking-widest">
          Register
        </button>
      </div>
      <LoginComponent v-if="displayLoginComponent"/>
      <RegisterComponent v-if="displayRegisterComponent"/>
    </div>
  </div>
</template>

<script setup>
import {ref} from "vue";

const displayLoginComponent = ref(true);
const displayRegisterComponent = ref(false);
const displayAuthComponent = (component) => {
  const isLogin = component === 'login';
  displayLoginComponent.value = isLogin;
  displayRegisterComponent.value = !isLogin;
}

// If user hits /auth endpoint and he's already authorized redirect directly to /dashboard
onBeforeMount(() => {
  const auth = useAuthStore();
  if (auth.isLoggedIn) return navigateTo('/dashboard');
})

</script>
