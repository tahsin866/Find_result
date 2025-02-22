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
        <header class="bg-emerald-900">
    <!-- Islamic Geometric Pattern Top -->
    <div class="" style="background-image: url('path-to-islamic-pattern.png')"></div>

    <div class="container mx-auto px-6 py-5">
        <div class="flex flex-col items-center">
            <!-- Arabic Bismillah -->


            <!-- Main Content -->
            <div class="w-full text-center space-y-6">
                <!-- Decorative Border Start -->
                <div class="flex justify-center mb-4">
                    <div class="border-2 border-emerald-300/30 p-1 rounded-md">
                        <div class="border-2 border-emerald-300/30 px-8 py-4 rounded-md">
                            <h1 class="text-5xl font-bold text-white">
                                বেফাকুল মাদারিসিল আরাবিয়া বাংলাদেশ
                            </h1>
                        </div>
                    </div>
                </div>

                <!-- Subtitle with Islamic Border -->
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="h-px w-full bg-emerald-300/20"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <h3 class=" rounded-md px-4 bg-gradient-to-r from-emerald-900 to-emerald-800 text-2xl font-bold text-emerald-100">
                            (বাংলাদেশ কওমী মাদরাসা শিক্ষাবোর্ড)
                        </h3>
                    </div>
                </div>

                <!-- Address with Decorative Elements -->
                <div class="flex justify-center items-center gap-4">
                    <span class="text-emerald-300">❖</span>
                    <h3 class="text-2xl font-bold text-emerald-100">
                        ২০৫, কাজলার পাড় (ভাঙ্গাপ্রেস), যাত্রাবাড়ী, ঢাকা-১২৩৬
                    </h3>
                    <span class="text-emerald-300">❖</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Islamic Geometric Pattern Bottom -->
    <div class="h-4 bg-repeat-x transform rotate-180" style="background-image: url('path-to-islamic-pattern.png')"></div>
</header>

        <!-- Main Content -->
        <main class="container mx-auto px-6 py-8 flex-grow bg-[#F8F9FA]">
    <!-- Decorative Header -->


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Individual Result Card -->
        <Link :href="route('find_result.studentResultFind')"
            class="group bg-white rounded-xl shadow-sm transition-all duration-500 ease-in-out hover:shadow-xl hover:-translate-y-1">
            <div class="border border-emerald-800/10 rounded-xl overflow-hidden">
                <div class="h-2 bg-emerald-800 opacity-90"></div>
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 rounded-lg bg-emerald-800/95 flex items-center justify-center shadow-inner">
                            <span class="text-xl text-white font-arabic">طالب</span>
                        </div>
                        <h3 class="text-lg font-bold text-emerald-900">ব্যক্তিগত ফলাফল অনুসন্ধান</h3>
                    </div>
                    <p class="text-emerald-800/70 text-base mb-4">পরীক্ষার ফলাফল দেখুন</p>
                    <div class="flex items-center gap-2 text-emerald-800/40">
                        <span>◈</span>
                        <div class="h-px flex-grow bg-emerald-800/10"></div>
                        <span>◈</span>
                    </div>
                </div>
            </div>
        </Link>

        <!-- Marhala Result Card -->
        <Link :href="route('find_result.marhalawariFindResult')"
            class="group bg-white rounded-xl shadow-sm transition-all duration-500 ease-in-out hover:shadow-xl hover:-translate-y-1">
            <div class="border border-emerald-800/10 rounded-xl overflow-hidden">
                <div class="h-2 bg-emerald-800 opacity-90"></div>
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 rounded-lg bg-emerald-800/95 flex items-center justify-center shadow-inner">
                            <span class="text-xl text-white font-arabic">مرحلة</span>
                        </div>
                        <h3 class="text-lg font-bold text-emerald-900">মারহালাওয়ারী ফলাফল</h3>
                    </div>
                    <p class="text-emerald-800/70 text-base mb-4">মারহালাওয়ারী ফলাফল যাচাই করুন</p>
                    <div class="flex items-center gap-2 text-emerald-800/40">
                        <span>◈</span>
                        <div class="h-px flex-grow bg-emerald-800/10"></div>
                        <span>◈</span>
                    </div>
                </div>
            </div>
        </Link>

        <!-- Merit List Card -->
        <Link :href="route('find_result.merit_list')"
            class="group bg-white rounded-xl shadow-sm transition-all duration-500 ease-in-out hover:shadow-xl hover:-translate-y-1">
            <div class="border border-emerald-800/10 rounded-xl overflow-hidden">
                <div class="h-2 bg-emerald-800 opacity-90"></div>
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 rounded-lg bg-emerald-800/95 flex items-center justify-center shadow-inner">
                            <span class="text-xl text-white font-arabic">نتيجة</span>
                        </div>
                        <h3 class="text-lg font-bold text-emerald-900">মেধা তালিকা</h3>
                    </div>
                    <p class="text-emerald-800/70 text-base mb-4">মারহালাওয়ারী ফলাফল যাচাই করুন</p>
                    <div class="flex items-center gap-2 text-emerald-800/40">
                        <span>◈</span>
                        <div class="h-px flex-grow bg-emerald-800/10"></div>
                        <span>◈</span>
                    </div>
                </div>
            </div>
        </Link>
    </div>
</main>


        <!-- Footer -->
        <footer class="bg-emerald-900 text-white relative">
    <!-- Top Decorative Border -->


    <div class="container mx-auto px-6 py-3">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Contact Information -->
            <div class="text-center">
                <h4 class="text-xl font-bold text-emerald-300 mb-4">যোগাযোগ</h4>
                <div class="space-y-2">
                    <p>ফোন: +৮৮-০২-৭৫৪৮৯৩৪</p>
                    <p>মোবাইল: +৮৮-০১৭১১-১২৩৪৫৬</p>
                    <p>ইমেইল: info@befaq.org.bd</p>
                </div>
            </div>

            <!-- Main Content -->


            <!-- Quick Links -->
            <div class="text-center">
                <h4 class="text-xl font-bold text-emerald-300 mb-4">দ্রুত লিংক</h4>
                <div class="space-y-2">
                    <p><a href="#" class="hover:text-emerald-300 transition">আমাদের সম্পর্কে</a></p>
                    <p><a href="#" class="hover:text-emerald-300 transition">নোটিশ বোর্ড</a></p>
                    <p><a href="#" class="hover:text-emerald-300 transition">যোগাযোগ করুন</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Decorative Border -->

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
