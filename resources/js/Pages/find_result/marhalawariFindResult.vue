<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';



const props = defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  availableYears: Array,
  marhalas: Object,
  searchResults: Object,
  studentDetails: Object
});

const searchResults = props.searchResults || { data: [], last_page: 1 };


const studentDetails = props.studentDetails || {};

const form = ref({
    CID: '',
    years: '',
    Roll: '',
    reg_id: '',
    Elhaq: ''  // Add this property
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


const maleSubjects = [
  { name: 'মিশকাতুল মাসাবিহ (প্রথম খন্ড)' },
  { name: 'তাফসীরে বায়দাভী' },
  { name: 'শরহুল আকায়েদ ও ফিরাকুল বাতিলা' },
  { name: 'মিশকাতুল মাসাবিহ (দ্বিতীয় খন্ড)' },
  { name: 'হেদায়া (তৃতীয় খন্ড)' },
  { name: 'হেদায়া (চতুর্থ খন্ড)' },
  { name: 'নুযহাতুন নযর' },
  { name: 'তাহরীকে দারুল উলূম দেওবন্দ' }
];

const femaleSubjects = [
  { name: 'মিশকাতুল মাসাবিহ (প্রথম খন্ড)' },
  { name: 'তাফসীরে জালালাইন (প্রথম খন্ড)' },
  { name: 'তাফসীরে জালালাইন (দ্বিতীয় খন্ড)' },
  { name: 'মিশকাতুল মাসাবিহ (দ্বিতীয় খন্ড)' },
  { name: 'হেদায়া (তৃতীয় খন্ড)' },
  { name: 'হেদায়া (চতুর্থ খন্ড)' },
  { name: 'আকীদাতুত তাহাবী' }
];

const getSubjects = (student) => {
  return student?.SRType === 0 ? femaleSubjects : maleSubjects;
};






const getGrade = (marks) => {
    if (!marks) return 'N/A';
    const numericMarks = Number(marks);
    if (numericMarks >= 80) return 'মুমতাজ';
    if (numericMarks >= 70) return 'জায়্যিদ জিদ্দান';
    if (numericMarks >= 60) return 'জায়্যিদ';
    if (numericMarks >= 33) return 'মকবুল';
    return 'F';
}

// const search = () => {
//     if (!form.value.CID || !form.value.years || !form.value.Elhaq) {
//         alert('Please fill all required fields');
//         return;
//     }

//     router.get(route('find_result.studentResultFind'), form.value, {
//         preserveState: true,
//         preserveScroll: true,
//         only: ['searchResults']
//     });
// };


// Function to calculate percentage
// const calculatePercentage = (obtained, total) => {
//     return ((obtained / total) * 100).toFixed(2);
// };

const downloadPDF = () => {
    const element = document.querySelector('.bg-white');
    const opt = {
        margin: 1,
        filename: 'result.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    };

    html2pdf().set(opt).from(element).save();
};

const search = () => {
    if (!form.value.CID) {
        alert('মারহালা নির্বাচন করুন');
        return;
    }
    if (!form.value.years) {
        alert('বছর নির্বাচন করুন');
        return;
    }
    if (!form.value.Elhaq) {
        alert('রোল নম্বর লিখুন');
        return;
    }

    router.get(route('find_result.marhalawariFindResult'), {
        CID: form.value.CID,
        years: form.value.years,
        Elhaq: form.value.Elhaq
    }, {
        preserveState: true,
        preserveScroll: true
    });
};



const fetchPage = (page) => {
    if (page > 0 && page <= searchResults.last_page) {
        Inertia.visit(route('find_result.marhalawariFindResult'), {
            method: 'get',
            data: {
                CID: form.value.CID,
                years: form.value.years,
                Elhaq: form.value.Elhaq,
                page: page
            },
            preserveState: true,
            replace: true,
            only: ['searchResults']  // Only update specific data without full reload
        });
    }
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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 items-end">
        <div>
            <label class="block text-gray-700 mb-2 font-semibold">মারহালা নির্বাচন করুন</label>
            <select v-model="form.CID" class="w-full border rounded-md p-2">
                <option value="">নির্বাচন করুন</option>
                <option v-for="(name, id) in marhalas" :key="id" :value="id">
                    {{ name }}
                </option>
            </select>
        </div>

        <div>
            <label class="block text-black mb-2 font-semibold">বছর নির্বাচন করুন</label>
            <select v-model="form.years" class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#004D40] text-black">
                <option value="">সন নির্বাচন করুন</option>
                <option v-for="year in availableYears" :key="year" :value="year">{{ year }}</option>
            </select>
        </div>

        <div>
            <label class="block text-black mb-2 font-semibold">ইলহাক নম্বর দিন</label>
            <input
                v-model="form.Elhaq"
                type="text"
                placeholder="রোল নম্বর লিখুন"
                class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#004D40] text-black"
            >
        </div>

        <div class="text-right">
            <button @click="search" class="bg-[#1a237e] text-white px-8 py-2 rounded-md hover:bg-[#283593] transition-colors w-full">
                ফলাফল খুঁজুন
            </button>
        </div>
    </div>
</div>


            <!-- Results Section -->
<!-- Results Section -->
<div v-if="searchResults?.data && searchResults.data.length > 0" class="bg-white rounded-md shadow-xl p-6 relative">
    <!-- Action Buttons -->
    <div class="absolute top-6 right-6 flex space-x-4">
        <button
            @click="printTable"
            class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 shadow-md">
            প্রিন্ট করুন
        </button>
        <button
            @click="downloadPDF"
            class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 shadow-md">
            PDF ডাউনলোড
        </button>
    </div>

    <!-- Madrasa Information -->
    <div class="mb-8">
        <h3 class="text-2xl font-bold text-[#1a237e] mb-4">মাদরাসার তথ্য</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div class="flex justify-between border-b pb-2 text-black">
                    <span class="font-semibold">মাদরাসার নাম:</span>
                    <span>{{ searchResults.data[0]?.Madrasha }}</span>
                </div>
                <div class="flex justify-between border-b pb-2 text-black">
                    <span class="font-semibold">ইলহাক নম্বর:</span>
                    <span>{{ searchResults.data[0]?.Elhaq }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="space-y-4">
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
                        <span class="font-bold">{{(student.Positions) }}তম</span>
                    </div>
                </div>
            </div>
        </div> -->


    <!-- Students Results Table -->
    <div class="overflow-x-auto">
        <table id="resultsTable" class="w-full border border-gray-200 rounded-md">
            <thead class="bg-gray-50 text-black">
                <tr>
                    <th class="px-4 py-2 text-left">রোল</th>
                    <th class="px-4 py-2 text-left">নাম</th>
                    <th v-for="(subject, index) in getSubjects(searchResults.data[0])"
                        :key="index"
                        class="px-4 py-2 text-center">
                        {{ subject.name }}
                    </th>
                    <th class="px-4 py-2 text-center">মোট</th>
                    <th class="px-4 py-2 text-center">বিভাগ</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-black">
                <tr v-for="student in searchResults.data" :key="student.id">
                    <td class="px-4 py-2">{{ student.Roll }}</td>
                    <td class="px-4 py-2">{{ student.Name }}</td>
                    <td v-for="n in 8" :key="n" class="px-4 py-2 text-center">
                        {{ student[`SubValue_${n}`] }}
                    </td>
                    <td class="px-4 py-2 text-center font-bold">{{ student.Total }}</td>
                    <td class="px-4 py-2 text-center">{{ student.Division }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex items-center justify-center space-x-2">
        <button
            @click="fetchPage(searchResults.current_page - 1)"
            :disabled="!searchResults.prev_page_url"
            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 disabled:opacity-50">
            পূর্ববর্তী
        </button>
        <span class="text-gray-700">পৃষ্ঠা {{ searchResults.current_page }} এর {{ searchResults.last_page }}</span>
        <button
            @click="fetchPage(searchResults.current_page + 1)"
            :disabled="!searchResults.next_page_url"
            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 disabled:opacity-50">
            পরবর্তী
        </button>
    </div>
</div>


<!-- No Results Message -->
<div v-else-if="form.CID && form.years && form.Elhaq" class="bg-white rounded-md shadow-xl p-6 text-center py-8">
    <p class="text-xl text-gray-600">কোন ফলাফল পাওয়া যায়নি</p>
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
