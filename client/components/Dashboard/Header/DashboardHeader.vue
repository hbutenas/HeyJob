<template>
  <div class="container mx-auto text-primary mt-5 flex justify-between">
    <div class="flex justify-center flex-grow">
      <nav class="flex">

        <NuxtLink
          class="p-3 text-primary no-underline tracking-wider text-sm transition duration-300 ease-in-out hover:text-secondary"
          to="/">
          Jobs
        </NuxtLink>

        <NuxtLink
          class="p-3 text-primary no-underline tracking-wider text-sm transition duration-300 ease-in-out hover:text-secondary"
          to="pricing">
          Pricing
        </NuxtLink>

        <NuxtLink
          class="p-3 text-primary no-underline tracking-wider text-sm transition duration-300 ease-in-out hover:text-secondary"
          to="about">
          About
        </NuxtLink>

        <NuxtLink
          class="p-3 text-primary no-underline tracking-wider text-sm transition duration-300 ease-in-out hover:text-secondary"
          to="dashboard">
          About
        </NuxtLink>
      </nav>
    </div>
    <!--  -->
    <div class="flex justify-end">

      <!-- User Circle with Email using Tailwind CSS -->
      <div
        class="w-10 h-10 rounded-full bg-purple-200 flex items-center justify-center cursor-pointer text-sm text-gray-800"
        data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start">
        {{ emailFirstLetter }}
      </div>

      <!-- Dropdown menu -->
      <div id="userDropdown"
        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
          <div class="text-xs font-semibold mb-1">{{ type }}</div>
          <div class=" text-xs truncate">{{ email }}</div>
        </div>
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
          <li>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
          </li>
          <li>
            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Jobs</a>
          </li>
          <li>
            <a href="#"
              class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Subscription</a>
          </li>
        </ul>
        <div class="py-1">
          <NuxtLink
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white cursor-pointer"
            @click.prevent="handleLogoutButton">
            Sign out
          </NuxtLink>
        </div>
      </div>

    </div>

  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { initFlowbite, initDropdowns } from 'flowbite';

const auth = useAuthStore();

// Receive first letter of the email and uppercase it
const emailFirstLetter = auth.user.data.email.slice(0, 1).toUpperCase();

// Capitalize first letter
const type = auth.user.data.type.charAt(0).toUpperCase() + auth.user.data.type.slice(1);
const email = auth.user.data.email.charAt(0).toUpperCase() + auth.user.data.email.slice(1);


onMounted(() => {
  initFlowbite();
});

const handleLogoutButton = async () => {
  // Log out user
  await auth.logout();

  
  // Redirect to / page
  return navigateTo("/");

};
</script>
