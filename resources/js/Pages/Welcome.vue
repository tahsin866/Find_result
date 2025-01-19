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
    <Head title="مدرسة العلوم الإسلامية" />

<div
style=" font-family: 'Merriweather','SolaimanLipi',sans-serif;"

class="flex flex-col min-h-screen bg-[#F8F0E3]">
    <!-- Elegant Header with Arabic Calligraphy Style -->
    <header class="bg-[#2C3E50] shadow-xl border-b-4 border-[#DAA520]">
    <div class="container mx-auto px-6 py-10 flex justify-between items-center">
        <div class="flex items-center gap-4 flex-grow">
            <img src="/logo.png" alt="Logo" class="h-12 w-12">
            <div class="text-center w-full">
                <h1 class="text-3xl font-arabic text-[#DAA520]">وَفَاقُ الْمَدَارِسِ الْعَرَبِيَّةِ بَنْغْلَادِيشْ</h1>
                <h2 class="text-white text-xl">বেফাকুল মাদারিসিল আরাবিয়া বাংলাদেশ</h2>
            </div>
        </div>

        <nav v-if="canLogin" class="flex gap-4">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="bg-[#DAA520] px-6 py-2 rounded-md text-white hover:bg-[#B8860B] transition-all duration-300 shadow-lg"
            >
                ড্যাশবোর্ড
            </Link>
            <template v-else>
                <Link
                    :href="route('login')"
                    class="bg-[#DAA520] px-6 py-2 rounded-md text-white hover:bg-[#B8860B] transition-all duration-300 shadow-lg"
                >
                    লগইন
                </Link>
            </template>
        </nav>
    </div>
</header>


    <!-- Refined Main Content -->
    <main class="relative sm:flex sm:justify-center sm:items-center  bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-[#C19A6B] selection:text-white">
    <div class="max-w-7xl mx-auto p-6 lg:p-8">


        <!-- Grid Cards -->
        <div class="mt-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                <!-- Result Search Card -->
                <a :href="route('find_result.studentResultFind')" class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-[#C19A6B]">
                    <div>
                        <div class="h-16 w-16 bg-[#1B4F72] flex items-center justify-center rounded-full">
                            <svg class="w-8 h-8 text-[#C19A6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">ফলাফল অনুসন্ধান</h2>
                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            নম্বরপত্র ও সনদপত্র যাচাই করুন। আপনার ফলাফল সহজেই খুঁজে পান।
                        </p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 stroke-[#C19A6B] w-6 h-6 mx-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                    </svg>
                </a>

                <!-- Certificate Verification Card -->


                <a href="#" class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-[#C19A6B]">
                    <div>
                        <div class="h-16 w-16 bg-[#1B4F72] flex items-center justify-center rounded-full">
                            <svg class="w-8 h-8 text-[#C19A6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">সনদ যাচাই</h2>
                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            সনদপত্রের প্রামাণিকতা যাচাই করুন। নিশ্চিত হোন আপনার সনদের বৈধতা নিয়ে।
                        </p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 stroke-[#C19A6B] w-6 h-6 mx-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                    </svg>
                </a>

                <!-- Marhalawari Results Card -->
                <a href="#" class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-[#C19A6B]">
                    <div>
                        <div class="h-16 w-16 bg-[#1B4F72] flex items-center justify-center rounded-full">
                            <svg class="w-8 h-8 text-[#C19A6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">মারহালাওয়ারী ফলাফল</h2>
                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            মারহালা ভিত্তিক ফলাফল দেখুন। সকল স্তরের পরীক্ষার ফলাফল একসাথে।
                        </p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 stroke-[#C19A6B] w-6 h-6 mx-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                    </svg>
                </a>

                <!-- Merit List Card -->
                <a href="#" class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-[#C19A6B]">
                    <div>
                        <div class="h-16 w-16 bg-[#1B4F72] flex items-center justify-center rounded-full">
                            <svg class="w-8 h-8 text-[#C19A6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">মেধা তালিকা</h2>
                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            মেধা তালিকা অনুসন্ধান করুন। সেরা ফলাফল অর্জনকারীদের তালিকা দেখুন।
                        </p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 stroke-[#C19A6B] w-6 h-6 mx-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Footer Links -->
        <div class="flex justify-center mt-16 px-6 sm:items-center sm:justify-between">
            <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left">
                <div class="flex items-center gap-4">

                </div>
            </div>
        </div>
    </div>
</main>


    <!-- Elegant Footer -->
    <!-- <footer class="bg-[#2C3E50] text-white py-10 border-t-4 border-[#DAA520]">
        <div class="container mx-auto px-6 text-center">
            <p class="text-[#DAA520] font-arabic text-xl mb-2">جميع الحقوق محفوظة</p>
            <p class="text-sm">© ২০২৪ বেফাকুল মাদারিসিল আরাবিয়া বাংলাদেশ</p>
        </div>
    </footer> -->

    <footer class="bg-[#1B4F72] text-white py-8 border-t-4 border-[#C19A6B]">
            <div class="container mx-auto px-6 text-center">
                <p class="text-[#C19A6B] font-arabic text-2xl mb-3">جميع الحقوق محفوظة</p>
                <p class="text-sm">© ২০২৪ বেফাকুল মাদারিসিল আরাবিয়া বাংলাদেশ</p>
            </div>
        </footer>
</div>
</template>





