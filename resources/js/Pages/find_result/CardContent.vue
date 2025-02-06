<template>
    <div class="flex items-center gap-4 mb-4">
      <div class="w-12 h-12 rounded-lg bg-[#2C5A63] flex items-center justify-center">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="icon" />
        </svg>
      </div>
      <h3 class="text-xl font-semibold text-[#2C5A63]">{{ title }}</h3>
    </div>
    <p class="text-gray-600">{{ description }}</p>
  </template>

  <script setup>
  defineProps({
    title: String,
    description: String,
    icon: String
  })
  </script>
