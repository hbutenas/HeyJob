<template>
  <AuthComponent @authEmit="handleSubmitButton">
    <!-- Error header -->
    <h2 v-if="registrationFailed" class="mb-4 text-primary tracking-wider text-sm text-center">
      {{ registrationFailedMessage }}</h2>

    <!-- Email field -->
    <div class="mb-4">
      <label class="text-primary text-sm font-bold" for="email">
        Email address
      </label>

      <input class="border rounded w-full py-2 px-3 mt-1 text-gray-700 leading-tight focus:outline-none"
             id="email" type="email" placeholder="Email" v-model="email" required>

    </div>

    <!-- Password field -->
    <div class="mb-6">
      <label class="text-primary text-sm font-bold" for="password">
        Password
      </label>


      <input
          class="border rounded w-full py-2 px-3 mt-1 text-gray-700 mb-3 leading-tight focus:outline-none"
          id="password" type="password" placeholder="******************" v-model="password" required>

    </div>

    <!-- Submit button -->
    <div class="flex items-center justify-between">
      <button
          class="bg-white hover:bg-gray-100 text-alternatePrimary font-medium w-full font-semiboldl tracking-wider text-sm py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          type="submit">
        Sign In
      </button>
    </div>

    <!-- Or Separator -->
    <div class="flex items-center relative mb-6 mt-6">
      <div class="flex-1 border-b"></div>
      <p class="text-primary uppercase mx-2 text-sm tracking-wider">OR</p>
      <div class="flex-1 border-b"></div>
    </div>

    <!-- Sign in with Google -->
    <button
        class="flex items-center justify-center bg-white hover:bg-gray-100 font-medium py-2 px-4 mb-4 rounded focus:outline-none focus:shadow-outline w-full">
                    <span class="mr-2">
                        <img class="w-6 h-6" src="https://www.svgrepo.com/show/475656/google-color.svg" loading="lazy"
                             alt="google logo">
                    </span>
      Sign in with Google
    </button>

    <!-- Sign in with Facebook  -->
    <button
        class="flex items-center justify-center bg-white hover:bg-gray-100 font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                    <span class="mr-2">
                        <img class="w-6 h-6" src="https://www.svgrepo.com/show/475647/facebook-color.svg" loading="lazy"
                             alt="google logo">
                    </span>
      Continue with Facebook
    </button>
  </AuthComponent>
</template>


<script setup>
import {ref} from "vue";
import {useAuthStore} from "~/stores/useAuthStore";

const auth = useAuthStore();
const email = ref('');
const password = ref('');
const registrationFailed = ref(false);
const registrationFailedMessage = ref('Invalid email address or password');

const handleSubmitButton = async () => {
  // define user data
  const userData = ref({
    email: email.value.trim(),
    password: password.value.trim()
  });

  // sign in user
  const response = await auth.login(userData.value);

  // checks if response.error.value exists and is not null before attempting to read the data property, preventing the TypeError issue
  const errorMessage = response.error.value && response.error.value.data ? response.error.value.data.message : false;

  // failed to login user due errors
  if (errorMessage) {
    registrationFailed.value = true;
    registrationFailedMessage.value = errorMessage;
    password.value = '';
    return;
  }

  // successfully logged-in  user, redirect to dashboard
  return navigateTo('/dashboard');

}
</script>
