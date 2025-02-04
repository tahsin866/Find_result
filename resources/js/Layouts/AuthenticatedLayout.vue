<script setup>
import { ref } from 'vue';

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
    href: '/GADGET-GEARS/category',

},


    {
        name: 'ইউজার একসেস',
        icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
        href: '/GADGET-GEARS/order',

    },
    {
        name: 'রিপোর্ট',
        icon: 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
        href: '/GADGET-GEARS/coustomar',
    },


]);



const showingNavigationDropdown = ref(false)
const unreadNotifications = ref(3)
const userProfile = ref({
  name: 'John Doe',
  email: 'john@example.com',
  role: 'Store Admin',
  status: 'online',
  lastLogin: '2 hours ago',
  avatar: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'
});


const isSidebarOpen = ref(false)

const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value
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
          <!-- AI Assistant Button -->
          <button class="btn-secondary flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <span>AI Assistant</span>
          </button>

          <!-- Voice Search -->
          <div class="relative w-96">
            <input type="text"
                   class="w-full rounded-lg border border-gray-200 bg-gray-50 pl-10 pr-12 py-2.5 text-sm text-gray-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                   placeholder="Search or use voice command (Press '/')">
            <div class="absolute left-3 top-2.5">
              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </div>
            <button class="absolute right-3 top-2.5 text-gray-400 hover:text-blue-500">
              <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
              </svg>
            </button>
          </div>

          <!-- Quick Actions -->
          <div class="relative">
            <button class="btn-primary flex items-center">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
              Quick Actions
            </button>
          </div>

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
          <div class="relative">
            <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                    class="flex items-center space-x-3 rounded-lg hover:bg-gray-50 p-2 transition-colors">
              <div class="relative">
                <img class="h-9 w-9 rounded-full object-cover border-2 border-gray-200"
                     :src="userProfile.avatar"
                     alt="Admin">
                <span class="absolute bottom-0 right-0 h-3 w-3 rounded-full border-2 border-white"
                      :class="userProfile.status === 'online' ? 'bg-green-400' : 'bg-gray-400'">
                </span>
              </div>
              <div class="hidden md:block text-left">
                <div class="text-sm font-semibold text-gray-800">{{ userProfile.name }}</div>
                <div class="text-xs text-gray-500">{{ userProfile.role }}</div>
              </div>
            </button>

            <!-- Enhanced Dropdown Menu -->
            <div v-show="showingNavigationDropdown"
                 class="absolute right-0 mt-2 w-64 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100">
              <div class="p-4">
                <div class="text-sm font-medium text-gray-900">{{ userProfile.name }}</div>
                <div class="text-sm text-gray-500">{{ userProfile.email }}</div>
                <div class="mt-2 text-xs text-gray-500">Last login: {{ userProfile.lastLogin }}</div>
              </div>
              <div class="py-1">
                <a href="/profile" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                  <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                  Profile Settings
                </a>
                <a href="/store" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                  <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                  </svg>
                  Store Settings
                </a>
              </div>
              <div class="py-1">
                <form method="POST" action="/logout">
                  <button type="submit" class="group flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-50">
                    <svg class="mr-3 h-5 w-5 text-red-400 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Sign Out
                  </button>
                </form>
              </div>
            </div>
          </div>
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
