<template>
  <AppLayout title="Gallery">

    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Gallery
        </h2>
    </template>

    <div class="mx-4 my-4">
      <button class="w-[300px] h-[300px] float-left bg-slate-300 text-2xl">
        Add New Photo
      </button>
      <div v-for="(photoUrl,i) in photos" :key="i" class="border-black mb-2 w-[300px] h-[300px] bg-slate-500 float-left mx-2 grid content-center cursor-pointer" @click="router.visit(photoUrl)" >
        <img :src="photoUrl" width="300" height="300">
      </div>
    </div>
  </AppLayout>

</template>

<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3'

import { BiSolidImageAdd } from 'react-icons/bi';

defineProps({
    photos: Array,
});

</script>

<style>

</style>