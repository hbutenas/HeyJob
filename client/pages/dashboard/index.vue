<template>
  <div class="blur-sm" data-unselectable="unselectable content">Dashboard23</div>

</template>

<script setup lang="ts">
import {definePageMeta} from "#imports";

definePageMeta({
  middleware: ['auth'],
});
</script>
