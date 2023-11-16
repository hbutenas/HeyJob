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
    <div class="mb-4">
      <label class="text-primary text-sm font-bold" for="password">
        Password
      </label>

      <input
          class="border rounded w-full py-2 px-3 mt-1 text-gray-700 leading-tight focus:outline-none"
          id="password" type="password" placeholder="******************" v-model="password" required>
    </div>

    <!-- Confirm password field -->
    <div class="mb-4">
      <label class="text-primary text-sm font-bold" for="confirm_password">
        Confirm Password
      </label>

      <input
          class="border rounded w-full py-2 px-3 mt-1 text-gray-700 leading-tight focus:outline-none"
          id="confirm_password" type="password" placeholder="******************" v-model="confirmedPassword" required>
    </div>

    <!-- Type selection -->
    <div class="mb-6">
      <label class="text-primary text-sm font-bold" for="password">
        Account type
      </label>

      <select v-model="userType" name="types" id="user-types"
              class="w-full border rounded py-1 px-2 mt-1 text-gray-700 mb-3">
        <option value="job_seeker">Job seeker</option>
        <option value="employer">Employer</option>
      </select>
    </div>

    <!-- Register button -->
    <div class="flex items-center justify-between">
      <button
          class="bg-white hover:bg-gray-100 text-alternatePrimary font-medium w-full font-semiboldl tracking-wider text-sm py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          type="submit">
        Register
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
const confirmedPassword = ref('');
const userType = ref('job_seeker');
const registrationFailed = ref(false);
const registrationFailedMessage = ref('Please choose an option from the list');
const handleSubmitButton = async () => {

  // validate option value
  const defaultUserTypes = ['job_seeker', 'employer'];

  // random value passed through options
  if (!defaultUserTypes.includes(userType.value)) {
    registrationFailed.value = true;
    registrationFailedMessage.value = 'Please choose an option from the list';
    return;
  }

  // define user data
  const userData = ref({
    email: email.value.trim(),
    password: password.value.trim(),
    password_confirmation: confirmedPassword.value.trim(),
    type: userType.value,
  });

  // create new user
  const {error: {value: {data: {errors}}}} = await auth.register(userData.value);
  // failed to register user due errors

  if (errors) {
    // loop through errors and display the error
    Object.keys(errors).forEach(error => {
      registrationFailed.value = true;
      registrationFailedMessage.value = errors[error][0];
      password.value = '';
      confirmedPassword.value = '';
    });
  } else {
    // successfully created new user, redirect to dashboard
    return navigateTo('/dashboard');
  }
}


</script>
