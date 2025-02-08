<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3'
import DropdownLink from '@/Components/DropdownLink.vue';
import Dropdown from '@/Components/Dropdown.vue';

// const showingNavigationDropdown = ref(false);
// const unreadNotifications = ref(3);
const unreadMessages = ref(5);

const sidebarItems = ref([
    {

        name: 'ড্যাশবোর্ড',
        icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
        href: '/dashboard'
    },
    {
        name: 'রেজাল্ট আপলোড',
        icon: 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
        href: '/uploadResult/resultUpload',

    },

    {
    name: 'নজরে সানি রেজাল্ট ',
    icon: 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z',
    href: '/uploadResult/nazre-sani',

},


    {
        name: 'ইউজার একসেস',
        icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
        href: '/uploadResult/useracsess',

    },
    {
        name: 'রিপোর্ট',
        icon: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
        href: '/GADGET-GEARS/coustomar',
    },


]);



const showingNavigationDropdown = ref(false)
const unreadNotifications = ref(3)



const isSidebarOpen = ref(false)

const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value
}

// Add to your existing script setup
import { router } from '@inertiajs/vue3'

const handleLogout = () => {
  router.post('/logout', {}, {
    onSuccess: () => {
      window.location.href = '/login'
    }
  })
}


</script>

<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Top Navigation Bar -->
        <button
          @click="toggleSidebar"
          class="fixed top-4 left-4 z-50 lg:hidden p-2 rounded-md bg-white shadow-lg"
          aria-label="Toggle sidebar"
        >
      <svg
        class="w-6 h-6"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
      >
        <path
          v-if="!isSidebarOpen"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16"
        />
        <path
          v-else
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M6 18L18 6M6 6l12 12"
        />
      </svg>
    </button>

        <nav class="bg-white border-b border-gray-200">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 justify-between">
        <!-- Logo and Brand -->
        <div class="flex items-center">
          <a href="#" class="flex items-center group">
            <img src="/images/LOGO1.jpg" class="h-8 w-auto transform transition-transform group-hover:rotate-180 duration-700" alt="Logo">
            <span class="ml-2 text-xl font-semibold">
<h1>WEMS</h1>
            </span>
          </a>
        </div>

        <!-- Right Navigation Items -->
        <div class="flex items-center space-x-6">

<!--
            <div class="flex-grow text-center">
    <h1 class="text-2xl font-bold">ওয়েমস রেজাল্ট মেনেজমেন্ট সিস্টেম</h1>
  </div> -->


          <!-- Notifications with Live Updates -->
          <button class="relative p-2 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center animate-pulse">
              {{ unreadNotifications }}
            </span>
          </button>

          <!-- Theme Switcher -->
          <button class="p-2 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
          </button>

          <!-- Enhanced Profile Dropdown -->
          <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button
                                            style=" font-family: 'Merriweather','SolaimanLipi',sans-serif;"
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 bg-white dark:bg-gray-800 border border-transparent text-md font leading-4 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300"
                                        >
                                            {{ $page.props.auth.user.name }}
                                            <svg
                                                class="-me-0.5 ms-2 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </span>
                                </template>
                                <template #content>
                                    <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button">Log Out</DropdownLink>
                                </template>
                            </Dropdown>
        </div>
      </div>
    </div>
  </nav>
        <!-- Sidebar and Main Content -->
        <div style=" font-family: 'Merriweather','SolaimanLipi',sans-serif; font-size: " class= "flex h-[calc(100vh-4rem)]">

            <!-- Sidebar -->
            <div v-if="isSidebarOpen"
                 @click="toggleSidebar"
                 class="fixed inset-0 bg-gray-600 bg-opacity-75 transition-opacity lg:hidden">
            </div>
            <!-- <aside class="w-64 bg-white border-r border-gray-200 overflow-y-auto">

            </aside> -->


            <aside :class="[
              'fixed inset-y-0 left-0 transform lg:relative lg:translate-x-0 transition duration-300 ease-in-out z-40 sidebar-enter-active sidebar-leave-active',
              isSidebarOpen ? 'translate-x-0' : '-translate-x-full'
            ]">
        <!-- ... existing sidebar content ... -->
        <nav class="p-4 space-y-1">
                    <a v-for="item in sidebarItems"
                       :key="item.name"
                       :href="item.href"
                       class="flex items-center px-3 py-2.5 text-sm font-medium rounded-lg text-gray-900 hover:bg-gray-50 group">
                        <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-blue-500"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  :d="item.icon" />
                        </svg>
                        {{ item.name }}
                        <span v-if="item.badge"
                              class="ml-auto bg-gray-100 text-gray-600 py-0.5 px-2 rounded-full text-xs min-w-[2rem] text-center">
                            {{ item.badge }}
                        </span>
                    </a>
                </nav>
      </aside>





            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-4 lg:p-6">
                <div class="mx-2">
                    <header class="mb-6">
                        <slot name="header" />
                    </header>

                    <div class="bg-white rounded-lg shadow">
                        <slot />
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

<style scoped>
.btn-primary {
    @apply inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 border border-transparent;
}

.sidebar-enter-active,
.sidebar-leave-active {
  transition: transform 0.3s ease-in-out;
}

.sidebar-enter-from,
.sidebar-leave-to {
  transform: translateX(-100%);
}
</style>
