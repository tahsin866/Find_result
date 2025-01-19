<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    availableYears: Array,
    marhalas: Object,
    searchResults: Object // Changed to Object for pagination
});

const studentDetails = props.studentDetails || {};

const form = ref({
    CID: '',
    years: '',
    Roll: '',
    reg_id: ''
});



const maleSubjects = [
    { name: 'مشكوة المصابيح (الجزء الأول)' },
    { name: 'تفسير البيضاوي' },
    { name: 'شرح العقائد و الفرق الباطلة' },
    { name: 'مشكوة المصابيح (الجزء الثاني)' },
    { name: 'الهداية (الجزء الثالث)' },
    { name: 'الهداية (الجزء الرابع)' },
    { name: 'نزهة النظر في شرح نخبة الفكر' },
    { name: 'تحريك دار العلوم ديوبند' }
];

const femaleSubjects = [
    { name: 'مشكوة المصابيح (الجزء الأول)' },
    { name: 'تفسيرجلالين (الجزء الأول)' },
    { name: 'تفسيرجلالين (الجزء الثاني)' },
    { name: 'مشكوة المصابيح (الجزء الثاني)' },
    { name: 'الهداية (الجزء الثالث)' },
    { name: 'الهداية (الجزء الرابع)' },
    { name: 'عقيدة الطحاوي' }
];

const currentSubjects = computed(() => {
    return studentDetails.SRType === 0 ? femaleSubjects : maleSubjects;
});

const studentResults = ref({
    SubValue_1: studentDetails.SubValue_1 || '',
    SubValue_2: studentDetails.SubValue_2 || '',
    SubValue_3: studentDetails.SubValue_3 || '',
    SubValue_4: studentDetails.SubValue_4 || '',
    SubValue_5: studentDetails.SubValue_5 || '',
    SubValue_6: studentDetails.SubValue_6 || '',
    SubValue_7: studentDetails.SubValue_7 || '',
    SubValue_8: studentDetails.SubValue_8 || '',
    Total: studentDetails.Total || '',
    Division: studentDetails.Division || ''
});

const getGrade = (marks) => {
    if (!marks) return 'N/A';
    const numericMarks = Number(marks);
    if (numericMarks >= 80) return 'মুমতাজ';
    if (numericMarks >= 70) return 'জায়্যিদ জিদ্দান';
    if (numericMarks >= 60) return 'জায়্যিদ';
    if (numericMarks >= 33) return 'মকবুল';
    return 'F';
}

const search = () => {
    if (!form.value.CID || !form.value.years || !form.value.Roll || !form.value.reg_id) {
        alert('Please fill all required fields');
        return;
    }

    router.get(route('find_result.studentResultFind'), form.value, {
        preserveState: true,
        preserveScroll: true,
        only: ['searchResults']
    });
};


// Function to calculate percentage
// const calculatePercentage = (obtained, total) => {
//     return ((obtained / total) * 100).toFixed(2);
// };



</script>

<template>
    <Head title="মাদ্রাসা ফলাফল" />
    <div

    style=" font-family: 'Merriweather','SolaimanLipi',sans-serif;"

    class="bg-[#004D40] text-white min-h-screen">
        <!-- Islamic Pattern Background -->
        <div class="absolute inset-0 opacity-10">
            <div class="islamic-pattern w-full h-full"></div>
        </div>

        <div class="relative">
            <!-- Header -->
            <header class="py-6 px-4">
                <div class="container mx-auto flex justify-between items-center">
                    <h1 class="text-2xl font-arabic">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</h1>
                    <nav v-if="canLogin" class="space-x-4">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="bg-[#00796B] px-4 py-2 rounded-md hover:bg-[#00695C] transition"
                        >
                            ড্যাশবোর্ড
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="bg-[#00796B] px-4 py-2 rounded-md hover:bg-[#00695C] transition"
                            >
                                লগইন
                            </Link>
                        </template>
                    </nav>
                </div>
            </header>

            <!-- Main Content -->
            <main class="container mx-auto px-4 py-6">
    <!-- Search Section -->
    <div class="bg-white rounded-md shadow-xl p-6 mb-8">
            <div class="flex flex-wrap items-end gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-black mb-2">মারহালা নির্বাচন করুন</label>
                    <select v-model="form.CID" class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#004D40] text-black">
                        <option value="">মারহালা নির্বাচন করুন</option>
                        <option v-for="(name, id) in marhalas" :key="id" :value="id">{{ name }}</option>
                    </select>
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label class="block text-black mb-2">সন</label>
                    <select v-model="form.years" class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#004D40] text-black">
                        <option value="">সন নির্বাচন করুন</option>
                        <option v-for="year in availableYears" :key="year" :value="year">{{ year }}</option>
                    </select>
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label class="block text-black mb-2">রোল নম্বর</label>
                    <input
                        v-model="form.Roll"
                        type="text"
                        placeholder="রোল নম্বর লিখুন"
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#004D40] text-black"
                    >
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label class="block text-black mb-2">রেজিস্ট্রেশন নম্বর</label>
                    <input
                        v-model="form.reg_id"
                        type="text"
                        placeholder="রেজিস্ট্রেশন নম্বর লিখুন"
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#004D40] text-black"
                    >
                </div>

                <div class="flex-none">
                    <button @click="search" class="bg-[#004D40] text-white px-8 py-2 rounded-md hover:bg-[#00695C] transition">
                        ফলাফল খুঁজুন
                    </button>
                </div>
            </div>
        </div>


    <!-- Result Sheet -->
    <div v-if="searchResults?.data?.length" class="bg-white rounded-md shadow-xl p-6">
        <div v-for="student in searchResults.data" :key="student.id">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Student Information -->
                <div class="space-y-4">
                    <div class="flex justify-between border-b pb-2 text-black">
                        <span class="font-semibold">নাম:</span>
                        <span>{{ student.Name }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2 text-black">
                        <span class="font-semibold">পিতার নাম:</span>
                        <span>{{ student.Father}}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2 text-black">
                        <span class="font-semibold">রোল নম্বর:</span>
                        <span>{{ student.Roll }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2 text-black">
                        <span class="font-semibold">রেজিস্ট্রেশন নম্বর:</span>
                        <span>{{ student.reg_id }}</span>
                    </div>
                </div>

                <!-- Result Information -->
                <div class="space-y-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-xl font-bold text-black mb-4">ফলাফল সারসংক্ষেপ</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between text-black">
                                <span class="font-semibold">মোট নম্বর:</span>
                                <span>800</span>
                            </div>
                            <div class="flex justify-between text-black">
                                <span class="font-semibold">প্রাপ্ত নম্বর:</span>
                                <span>{{ student.Total }}</span>
                            </div>
                            <div class="flex justify-between text-black">
                                <span class="font-semibold">শতকরা হার:</span>
                                <!-- <span>{{ calculatePercentage(student.Total, 800) }}%</span> -->
                            </div>
                            <div class="flex justify-between text-black">
                                <span class="font-semibold">ফলাফল:</span>
                                <span class="font-bold">{{ getGrade(student.Total) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Marks -->
            <div class="mt-8">
                <h3 class="text-xl font-bold text-black mb-4">বিস্তারিত নম্বর</h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr class="text-black">
                                <th class="px-4 py-2 text-left">বিষয়</th>
                                <th class="px-4 py-2 text-center">পূর্ণমান</th>
                                <th class="px-4 py-2 text-center">প্রাপ্ত নম্বর</th>
                                <th class="px-4 py-2 text-center">গ্রেড</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y text-black">
                            <tr v-for="(subject, index) in currentSubjects" :key="index">
                                <td class="px-4 py-2">{{ subject.name }}</td>
                                <td class="px-4 py-2 text-center">100</td>
                                <td class="px-4 py-2 text-center">
                                    {{ student[`SubValue_${index + 1}`] }}
                                </td>
                                <td class="px-4 py-2 text-center">
                                    {{ getGrade(student[`SubValue_${index + 1}`]) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <!-- <div class="mt-4 flex justify-center">
            <template v-for="link in searchResults.links" :key="link.label">
                <Link
                    :href="link.url"
                    v-html="link.label"
                    class="px-3 py-1 mx-1 rounded"
                    :class="{
                        'bg-[#004D40] text-white': link.active,
                        'bg-gray-200 text-gray-700': !link.active
                    }"
                />
            </template>
        </div> -->
    </div>
</main>


            <!-- Footer -->
            <footer class="text-center py-8 text-white/80">
                <p>সকল অধিকার সংরক্ষিত © {{ new Date().getFullYear() }}</p>
            </footer>
        </div>
    </div>
</template>

<style scoped>
.islamic-pattern {
    background-image: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M50 50c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10s-10-4.477-10-10 4.477-10 10-10zM10 10c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10c0 5.523-4.477 10-10 10S0 25.523 0 20s4.477-10 10-10zm10 8c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8zm40 40c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.font-arabic {
    font-family: 'Noto Naskh Arabic', serif;
}
</style>

