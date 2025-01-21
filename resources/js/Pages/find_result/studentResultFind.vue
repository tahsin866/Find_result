<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';




const props = defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  availableYears: Array,
  marhalas: Object,
  searchResults: Object,
  studentDetails: Object // Add this prop explicitly
});

const studentDetails = props.studentDetails || {};

const form = ref({
    CID: '',
    years: '',
    Roll: '',
    reg_id: ''
});



// const maleSubjects = [
//     { name: 'مشكوة المصابيح (الجزء الأول)' },
//     { name: 'تفسير البيضاوي' },
//     { name: 'شرح العقائد و الفرق الباطلة' },
//     { name: 'مشكوة المصابيح (الجزء الثاني)' },
//     { name: 'الهداية (الجزء الثالث)' },
//     { name: 'الهداية (الجزء الرابع)' },
//     { name: 'نزهة النظر في شرح نخبة الفكر' },
//     { name: 'تحريك دار العلوم ديوبند' }
// ];

// const femaleSubjects = [
//     { name: 'مشكوة المصابيح (الجزء الأول)' },
//     { name: 'تفسيرجلالين (الجزء الأول)' },
//     { name: 'تفسيرجلالين (الجزء الثاني)' },
//     { name: 'مشكوة المصابيح (الجزء الثاني)' },
//     { name: 'الهداية (الجزء الثالث)' },
//     { name: 'الهداية (الجزء الرابع)' },
//     { name: 'عقيدة الطحاوي' }
// ];

// const currentSubjects = computed(() => {
//     return studentDetails.SRType === 0 ? femaleSubjects : maleSubjects;
// });

// const studentResults = ref({
//     SubValue_1: studentDetails.SubValue_1 || '',
//     SubValue_2: studentDetails.SubValue_2 || '',
//     SubValue_3: studentDetails.SubValue_3 || '',
//     SubValue_4: studentDetails.SubValue_4 || '',
//     SubValue_5: studentDetails.SubValue_5 || '',
//     SubValue_6: studentDetails.SubValue_6 || '',
//     SubValue_7: studentDetails.SubValue_7 || '',
//     SubValue_8: studentDetails.SubValue_8 || '',
//     Total: studentDetails.Total || '',
//     Division: studentDetails.Division || ''
// });


// const maleSubjects = [
//   { name: 'মিশকাতুল মাসাবিহ (প্রথম খন্ড)' },
//   { name: 'তাফসীরে বায়দাভী' },
//   { name: 'শরহুল আকায়েদ ও ফিরাকুল বাতিলা' },
//   { name: 'মিশকাতুল মাসাবিহ (দ্বিতীয় খন্ড)' },
//   { name: 'হেদায়া (তৃতীয় খন্ড)' },
//   { name: 'হেদায়া (চতুর্থ খন্ড)' },
//   { name: 'নুযহাতুন নযর' },
//   { name: 'তাহরীকে দারুল উলূম দেওবন্দ' }
// ];

// const femaleSubjects = [
//   { name: 'মিশকাতুল মাসাবিহ (প্রথম খন্ড)' },
//   { name: 'তাফসীরে জালালাইন (প্রথম খন্ড)' },
//   { name: 'তাফসীরে জালালাইন (দ্বিতীয় খন্ড)' },
//   { name: 'মিশকাতুল মাসাবিহ (দ্বিতীয় খন্ড)' },
//   { name: 'হেদায়া (তৃতীয় খন্ড)' },
//   { name: 'হেদায়া (চতুর্থ খন্ড)' },
//   { name: 'আকীদাতুত তাহাবী' }
// ];


// const studentResults = ref({
//     SubValue_1: studentDetails.SubValue_1 || '',
//     SubValue_2: studentDetails.SubValue_2 || '',
//     SubValue_3: studentDetails.SubValue_3 || '',
//     SubValue_4: studentDetails.SubValue_4 || '',
//     SubValue_5: studentDetails.SubValue_5 || '',
//     SubValue_6: studentDetails.SubValue_6 || '',
//     SubValue_7: studentDetails.SubValue_7 || '',
//     SubValue_8: studentDetails.SubValue_8 || '',
//     Total: studentDetails.Total || '',
//     Division: studentDetails.Division || ''
// })

// const studentsub = ref({
//     SubLabel_1: studentDetails.SubLabel_1 || '',
//     SubLabel_2: studentDetails.SubLabel_2 || '',
//     SubLabel_3: studentDetails.SubLabel_3 || '',
//     SubLabel_4: studentDetails.SubLabel_4 || '',
//     SubLabel_5: studentDetails.SubLabel_5 || '',
//     SubLabel_6: studentDetails.SubLabel_6 || '',
//     SubLabel_7: studentDetails.SubLabel_7 || '',
//     SubLabel_8: studentDetails.SubLabel_8 || '',
//     Total: studentDetails.Total || '',
//     Division: studentDetails.Division || ''
// })


// const getSubjectData = computed(() => {
//     if (!searchResults.value?.data?.[0]) return [];

//     return Array.from({ length: 8 }, (_, i) => ({
//         name: searchResults.value.data[0][`SubLabel_${i + 1}`],
//         value: searchResults.value.data[0][`SubValue_${i + 1}`]
//     }));
// });


// const getSubjects = (student) => {
//   return student?.SRType === 0 ? femaleSubjects : maleSubjects;
// };


const getSubjectCount = (student) => {
    let count = 0;
    for (let i = 1; i <= 8; i++) {
        if (student[`SubLabel_${i}`]) count++;
    }
    return count || 8; // Default to 8 if count is 0
};



const getGrade = (marks) => {
    if (!marks) return 'N/A';
    const numericMarks = Number(marks);
    if (numericMarks >= 80) return 'মুমতাজ';
    if (numericMarks >= 70) return 'জায়্যিদ জিদ্দান';
    if (numericMarks >= 60) return 'জায়্যিদ';
    if (numericMarks >= 33) return 'মকবুল';
    return 'ফেল';
}

const search = () => {
    if (!form.value.CID || !form.value.years || !form.value.Roll || !form.value.reg_id) {
        alert('Please fill all required fields');
        return;
    }

    router.get(route('find_result.studentResultFind'), form.value, {
        preserveState: true,
        preserveScroll: true,
        only: ['searchResults'],
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    });
};


// Function to calculate percentage
// const calculatePercentage = (obtained, total) => {
//     return ((obtained / total) * 100).toFixed(2);
// };

const printCertificate = (student) => {
    window.open(route('printPdf', {
        Roll: student.Roll,
        reg_id: student.reg_id,
        action: 'I'
    }), '_blank');
};


const downloadCertificate = (student) => {
    window.location.href = route('generatePdf', {
        Roll: student.Roll,
        reg_id: student.reg_id
    });
};

</script>





<template>
    <Head title="ফলাফল" />

    <div style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="min-h-screen bg-gray-50">
        <!-- Header -->
        <header class="bg-[#1a237e] shadow-lg">
    <div class="container mx-auto px-6 py-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="w-full text-center mb-4 md:mb-0">
                <h1 class="text-5xl font-bold text-white">বেফাকুল মাদারিসিল আরাবিয়া বাংলাদেশ</h1>
                <h3 class="text-2xl font-bold text-white">(বাংলাদেশ কওমী মাদরাসা শিক্ষাবোর্ড)</h3>
                <h3 class="text-2xl font-bold text-white">২০৫, কাজলার পাড় (ভাঙ্গাপ্রেস), যাত্রাবাড়ী, ঢাকা-১২৩৬</h3>
            </div>
            <nav v-if="canLogin">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="bg-white text-[#1a237e] px-6 py-2 rounded hover:bg-gray-100 transition-colors"
                >
                    ড্যাশবোর্ড
                </Link>
            </nav>
        </div>
    </div>
</header>


        <!-- Main Content -->
        <main class="container mx-auto px-4 py-8">
            <!-- Search Form -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <div class="mb-6 text-left">
        <h2 class="text-2xl font-bold text-[#1a237e]">ব্যক্তিগত ফলাফল অনুসন্ধান</h2>
    </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-gray-700 mb-2 font-semibold">মারহালা নির্বাচন করুন</label>
                        <select v-model="form.CID" class="w-full border rounded-md p-2">
                            <option value="">নির্বাচন করুন</option>
                            <option v-for="(name, id) in marhalas" :key="id" :value="id">
                                {{ name }}
                            </option>
                        </select>
                    </div>

                    <div class="flex-1 min-w-[200px]">
                    <label class="block text-black mb-2 font-semibold">বছর নির্বাচন করুন</label>
                    <select v-model="form.years" class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#004D40] text-black">
                        <option value="">সন নির্বাচন করুন</option>
                        <option v-for="year in availableYears" :key="year" :value="year">{{ year }}</option>
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-black mb-2 font-semibold" >রোল নম্বর</label>
                    <input
                        v-model="form.Roll"
                        type="text"
                        placeholder="রোল নম্বর লিখুন"
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#004D40] text-black"
                    >
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label class="block text-black mb-2 font-semibold">রেজিস্ট্রেশন নম্বর</label>
                    <input
                        v-model="form.reg_id"
                        type="text"
                        placeholder="রেজিস্ট্রেশন নম্বর লিখুন"
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#004D40] text-black"
                    >
                </div>
                    <!-- Continue with other form fields -->
                    <!-- ... -->


                </div>

                <div class="mt-6 text-right">
                    <button @click="search" class="bg-[#1a237e] text-white px-8 py-2 rounded-md hover:bg-[#283593] transition-colors">
                        ফলাফল খুঁজুন
                    </button>
                </div>
            </div>

            <!-- Results Section -->
            <div v-for="student in searchResults.data" :key="student.id">



<div class="flex justify-end gap-4 mb-6">


    <button
    @click="printCertificate(student)"
    class="flex items-center gap-2 bg-[#004D40] text-white px-4 py-2 rounded-md hover:bg-[#00695C] transition"
>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
    </svg>
    প্রিন্ট করুন
</button>



<button
    @click="downloadPDF"
    class="flex items-center gap-2 bg-[#004D40] text-white px-4 py-2 rounded-md hover:bg-[#00695C] transition"
>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
    </svg>
    ডাউনলোড করুন
</button>
</div>


<div v-for="student in searchResults.data" :key="student.id">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Student Information -->
        <div class="space-y-4">
            <div class="flex justify-between border-b pb-2 text-black">
                <span class="font-semibold">নাম:</span>
                <span class="font-semibold">{{ student.Name }}</span>
            </div>
            <div class="flex justify-between border-b pb-2 text-black">
                <span class="font-semibold">পিতার নাম:</span>
                <span class="font-semibold">{{ student.Father}}</span>
            </div>
            <div class="flex justify-between border-b pb-2 text-black">
                <span class="font-semibold">রোল নম্বর:</span>
                <span class="font-semibold">{{ student.Roll }}</span>
            </div>
            <div class="flex justify-between border-b pb-2 text-black">
                <span class="font-semibold">রেজিস্ট্রেশন নম্বর:</span>
                <span class="font-semibold">{{ student.reg_id }}</span>
            </div>
            <div class="flex justify-between border-b pb-2 text-black">
                <span class="font-semibold">মাদরাসার নাম:</span>
                <span class="font-semibold">{{ student.Madrasha }}</span>
            </div>
        </div>

        <!-- Result Information -->
        <div class="space-y-4">
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-xl font-bold text-black mb-4">ফলাফল সারসংক্ষেপ</h3>
                <div class="space-y-2">
                    <div class="flex justify-between text-black">
                        <span class="font-semibold"> মোট পূর্ণমান:</span>
                        <span>৮০০</span>
                    </div>
                    <div class="flex justify-between text-black">
                        <span class="font-semibold">প্রাপ্ত নম্বর:</span>
                        <span>{{ student.Total }}</span>
                    </div>
                    <div class="flex justify-between text-black">
                        <span class="font-semibold">শতকরা হার:</span>
                        <span>{{(student.Total)/8 }}</span>
                    </div>
                    <div class="flex justify-between text-black">
                        <span class="font-semibold">বিভাগ:</span>
                        <span class="font-bold">{{(student.Division) }}</span>
                    </div>

                    <div class="flex justify-between text-black">
                        <span class="font-semibold">মেধা তালিকা:</span>
                        <span class="font-bold">{{(student.Positions) }} তম</span>
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
                <tbody class="divide-y text-black font-semibold">
    <tr v-for="index in getSubjectCount(student)" :key="index">
        <td class="px-4 py-2">{{ student[`SubLabel_${index}`] }}</td>
        <td class="px-4 py-2 text-center">১০০</td>
        <td class="px-4 py-2 text-center font-semibold">
            {{ student[`SubValue_${index}`] }}
        </td>
        <td class="px-4 py-2 text-center font-semibold">
            {{ getGrade(student[`SubValue_${index}`]) }}
        </td>
    </tr>
</tbody>


            </table>
        </div>
    </div>
</div>


</div>
        </main>
    </div>
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Bangla:wght@400;500;600;700&display=swap');

.result-container {
    font-family: 'Noto Bangla', sans-serif;
}

@media print {
    body * {
        visibility: hidden;
    }
    .result-container,
    .result-container * {
        visibility: visible;
    }
    .result-container {
        position: absolute;
        left: 0;
        top: 0;
    }
}
</style>
