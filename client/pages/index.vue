<template>
  <Header/>
</template>

<script setup>
// If user hits / endpoint, and he's already authorized redirect directly to /dashboard
onBeforeMount(() => {
  const auth = useAuthStore();
  if (auth.isLoggedIn) return navigateTo('/dashboard');
})
</script>
