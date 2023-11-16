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

    <div class="flex justify-end">
      <NuxtLink
          class="p-3 text-primary no-underline tracking-wider text-md transition duration-300 ease-in-out hover:text-accent"
          to="auth">
        Log in
      </NuxtLink>
    </div>

  </div>
</template>
