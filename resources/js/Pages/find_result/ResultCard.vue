<template>
    <Link
      v-if="href"
      :href="href"
      class="group p-6 bg-white border border-gray-200 rounded-lg hover:border-[#2C5A63] transition-all duration-200 shadow-sm hover:shadow-md"
    >
      <CardContent :title="title" :description="description" :icon="icon" />
    </Link>
    <div
      v-else
      class="group p-6 bg-white border border-gray-200 rounded-lg hover:border-[#2C5A63] transition-all duration-200 shadow-sm hover:shadow-md"
    >
      <CardContent :title="title" :description="description" :icon="icon" />
    </div>
  </template>

  <script setup>
  import { Link } from '@inertiajs/vue3';
  import CardContent from './CardContent.vue';
  defineProps({
    title: String,
    description: String,
    icon: String,
    href: String
  })
  </script>
