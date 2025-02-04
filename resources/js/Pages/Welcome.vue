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
        <header class="bg-[#2C5A63] shadow-lg">
            <div class="container mx-auto px-6 py-4">
                <div class="relative">
                    <div class="text-center mx-auto max-w-3xl">
                        <h1 class="text-5xl font-bold text-[#FFD700] mb-2">বেফাকুল মাদারিসিল আরাবিয়া বাংলাদেশ</h1>
                        <h3 class="text-2xl font-bold text-white mb-2">(বাংলাদেশ কওমী মাদরাসা শিক্ষাবোর্ড)</h3>
                        <h3 class="text-2xl font-bold text-white">২০৫, কাজলার পাড় (ভাঙ্গাপ্রেস), যাত্রাবাড়ী, ঢাকা-১২৩৬</h3>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-6 py-12 flex-grow">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Result Card -->
                <Link :href="route('find_result.studentResultFind')"
                    class="group p-6 bg-white border border-gray-200 rounded-lg hover:border-[#2C5A63] transition-all duration-200 shadow-sm hover:shadow-md">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-lg bg-[#2C5A63] flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-[#2C5A63]">ব্যক্তিগত ফলাফল অনুসন্ধান</h3>
                    </div>
                    <p class="text-gray-600">পরীক্ষার ফলাফল দেখুন</p>
                </Link>

                <!-- Certificate Card -->
                <Link :href="route('find_result.marhalawariFindResult')"
                    class="group p-6 bg-white border border-gray-200 rounded-lg hover:border-[#2C5A63] transition-all duration-200 shadow-sm hover:shadow-md">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-lg bg-[#2C5A63] flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-[#2C5A63]">মারহালাওয়ারী ফলাফল</h3>
                    </div>
                    <p class="text-gray-600">মারহালাওয়ারী ফলাফল যাচাই করুন</p>
                </Link>

                <!-- Merit List Card -->
                <div class="group p-6 bg-white border border-gray-200 rounded-lg hover:border-[#2C5A63] transition-all duration-200 shadow-sm hover:shadow-md">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-lg bg-[#2C5A63] flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-[#2C5A63]">মেধা তালিকা</h3>
                    </div>
                    <p class="text-gray-600">মেধা তালিকা দেখুন</p>
                </div>
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
</style>
