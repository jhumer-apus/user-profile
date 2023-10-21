<template>
  <AppLayout title="Gallery">

    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Gallery
        </h2>
    </template>

    <div class="grid grid-cols-4 gap-x-4 m-auto mt-4 md:w-3/4">
      <form @submit.prevent="submit">
        <div class="card">
          Add button
        <input
              ref="photoInput"
              type="file"
              class="opacity-0 h-full w-full cursor-pointer"
          >
      </div>

      </form>
      <div v-for="(photoUrl, i) in photos" :key="i" class="card" @click="router.visit(photoUrl)" >
        <img :src="photoUrl" width="300" height="300">
      </div>
    </div>
  </AppLayout>

</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { router, useForm } from '@inertiajs/vue3'

defineProps({
  photos: null,
});

const form = useForm({
  inputPhoto: null,
})

function submit() {
  form.post(route('/user/gallery/add-photo'),
    {
        preserveScroll: true,
    }
  )
}

</script>

<style scoped>
.card {
  @apply border-black mb-2 w-[300px] h-[300px] bg-slate-500  grid content-center cursor-pointer
}

</style>