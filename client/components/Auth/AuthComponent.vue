<template>
  <form @submit.prevent="$emit('authEmit')">
    <slot/>
  </form>
</template>

<script setup>

const emit = defineEmits([
  'authEmit',
]);

</script>
