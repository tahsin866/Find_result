<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}



</script>

<template>
    <Head title="মদরসা বোর্ড" />

    <div style="font-family: 'Amiri', 'Lateef', 'SolaimanLipi', sans-serif;" class="min-h-screen bg-gray-50 flex flex-col">
        <!-- Header -->
        <header class="bg-gradient-to-r from-[#0B4D2F] to-[#116D45] relative overflow-hidden">
    <!-- Islamic Pattern Overlay -->
    <div class="absolute inset-0 opacity-10">
      <div class="islamic-pattern w-full h-full"></div>
    </div>

    <!-- Decorative Domes -->
    <div class="absolute top-0 left-0 w-24 h-24 opacity-10">
      <!-- <svg viewBox="0 0 24 24" class="w-full h-full text-white" fill="currentColor">
        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
      </svg> -->
    </div>
    <div class="absolute top-0 right-0 w-24 h-24 opacity-10 transform rotate-90">
      <!-- <svg viewBox="0 0 24 24" class="w-full h-full text-white" fill="currentColor">
        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
      </svg> -->
    </div>

    <div class="container mx-auto px-6 py-8">
      <div class="relative">
        <div class="text-center mx-auto max-w-4xl">
          <!-- Logo -->
          <div class="flex justify-center mb-6">
            <!-- <div class="w-20 h-20 rounded-full bg-white/10 flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#FFD700]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
              </svg>
            </div> -->
          </div>

          <!-- Title -->

          <h2 class="text-4xl font-bold text-[#FFD700] mb-4">
            বেফাকুল মাদারিসিল আরাবিয়া বাংলাদেশ
          </h2>

          <!-- Subtitle -->
          <div class="space-y-3">
            <h3 class="text-2xl font-bold text-white">
              (বাংলাদেশ কওমী মাদরাসা শিক্ষাবোর্ড)
            </h3>
            <h3 class="text-xl font-bold text-white/90 flex items-center justify-center gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
              ২০৫, কাজলার পাড় (ভাঙ্গাপ্রেস), যাত্রাবাড়ী, ঢাকা-১২৩৬
            </h3>
          </div>
        </div>
      </div>
    </div>
  </header>

        <!-- Main Content -->
        <main class="container mx-auto px-6 py-12 flex-grow bg-[#F8F9FA]">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

      <!-- Individual Result Card -->
      <Link :href="route('find_result.studentResultFind')"
        class="group p-8 bg-white border-2 border-[#116D45]/20 rounded-lg hover:border-[#116D45] transition-all duration-300 shadow-md hover:shadow-xl relative overflow-hidden">
        <div class="islamic-pattern absolute inset-0 opacity-5"></div>
        <div class="relative">
          <div class="flex items-center gap-4 mb-4">
            <div class="w-14 h-14 rounded-full bg-[#116D45] flex items-center justify-center">
              <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-[#0B4D2F]">ব্যক্তিগত ফলাফল অনুসন্ধান</h3>
          </div>
          <p class="text-[#116D45]/80 text-lg">পরীক্ষার ফলাফল দেখুন</p>
        </div>
      </Link>

      <!-- Marhala Result Card -->
      <Link :href="route('find_result.marhalawariFindResult')"
        class="group p-8 bg-white border-2 border-[#116D45]/20 rounded-lg hover:border-[#116D45] transition-all duration-300 shadow-md hover:shadow-xl relative overflow-hidden">
        <div class="islamic-pattern absolute inset-0 opacity-5"></div>
        <div class="relative">
          <div class="flex items-center gap-4 mb-4">
            <div class="w-14 h-14 rounded-full bg-[#116D45] flex items-center justify-center">
              <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-[#0B4D2F]">মারহালাওয়ারী ফলাফল</h3>
          </div>
          <p class="text-[#116D45]/80 text-lg">মারহালাওয়ারী ফলাফল যাচাই করুন</p>
        </div>
      </Link>

      <!-- Merit List Card -->
      <Link :href="route('find_result.merit_list')"
        class="group p-8 bg-white border-2 border-[#116D45]/20 rounded-lg hover:border-[#116D45] transition-all duration-300 shadow-md hover:shadow-xl relative overflow-hidden">
        <div class="islamic-pattern absolute inset-0 opacity-5"></div>
        <div class="relative">
          <div class="flex items-center gap-4 mb-4">
            <div class="w-14 h-14 rounded-full bg-[#116D45] flex items-center justify-center">
              <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-[#0B4D2F]">মেধা তালিকা</h3>
          </div>
          <p class="text-[#116D45]/80 text-lg">মারহালাওয়ারী ফলাফল যাচাই করুন</p>
        </div>
      </Link>

    </div>
  </main>

        <!-- Footer -->
        <footer class="bg-[#2C5A63] text-white">
            <div class="container mx-auto px-6 py-8">
                <div class="text-center">
                    <p class="text-[#FFD700] font-arabic mb-2">جميع الحقوق محفوظة</p>
                    <p class="text-sm">© ২০২৪ বেফাকুল মাদারিসিল আরাবিয়া বাংলাদেশ</p>
                </div>
            </div>
        </footer>
    </div>
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Lateef&display=swap');

body {
    background-color: #f5f5f5;
}

header {
    background-image: url('/path/to/islamic-pattern.png'); /* Add an Islamic pattern background */
    background-repeat: repeat;
    background-size: 200px;
}

footer {
    background-image: url('/path/to/islamic-pattern.png'); /* Add an Islamic pattern background */
    background-repeat: repeat;
    background-size: 200px;
}

.islamic-pattern {
  background-image: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23116D45' fill-opacity='0.1'%3E%3Cpath d='M50 50c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10s-10-4.477-10-10 4.477-10 10-10zM10 10c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10S0 25.523 0 20s4.477-10 10-10zm10 8c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8zm40 40c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
</style>
