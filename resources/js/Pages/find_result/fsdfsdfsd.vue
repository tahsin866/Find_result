<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    availableYears: Array,
    marhalas: Object,
    searchResults: Array,
    totalStudents: Number,
    divisionCounts: Object,
    passRate: Number,
    failRate: Number,
    absentRate: Number,
    canLogin: Boolean, // Add this line
    canRegister: Boolean, // Add this if needed
    auth: Object // Add this if needed
});
// Remove duplicate searchResults ref since it's now in props
const form = ref({
    CID: '',
    years: '',
    Roll: '',
    reg_id: '',
    MElhaq: ''
});

// Add computed properties for statistics
// const statistics = computed(() => {
//     return {
//         totalStudents: props.totalStudents || 0,
//         divisionCounts: props.divisionCounts || {},
//         passRate: props.passRate || 0,
//         failRate: props.failRate || 0,
//         absentRate: props.absentRate || 0
//     };
// });
const results = computed(() => {
    return props.searchResults?.data || [];
});




const getSubjects = (student) => {
    const subjects = [];
    for (let i = 1; i <= 8; i++) {
        if (student[`SubLabel_${i}`]) {
            subjects.push({
                name: student[`SubLabel_${i}`],
                marks: student[`SubValue_${i}`]
            });
        }
    }
    return subjects;
};

const pageSize = ref(10);
const currentPage = ref(1);

const search = () => {
    if (!form.value.CID) {
        alert('মারহালা নির্বাচন করুন');
        return;
    }
    if (!form.value.years) {
        alert('বছর নির্বাচন করুন');
        return;
    }
    if (!form.value.MElhaq) {
        alert('ইলহাক নম্বর লিখুন');
        return;
    }

    fetchResults();
};

const fetchResults = () => {
    router.get(route('find_result.marhalawariFindResult'), {
        CID: form.value.CID,
        years: form.value.years,
        MElhaq: form.value.MElhaq,
        page: currentPage.value,
        per_page: pageSize.value
    }, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: (response) => {
            console.log('Search Results:', response.props.searchResults);
        }
    });
};

const changePageSize = () => {
    currentPage.value = 1;
    fetchResults();
};

const fetchPage = (page) => {
    currentPage.value = page;
    fetchResults();
};

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
</script>






<template>
    <Head title="ফলাফল" />

    <div style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="min-h-screen bg-gray-50">
        <!-- Header -->
        <header class="bg-gradient-to-r from-emerald-900 to-emerald-800 shadow-xl  border-emerald-600">
    <div class="container mx-auto px-6 py-5">
        <!-- Islamic Decorative Element Top -->


        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="w-full text-center space-y-4">
                <h1 class="text-5xl font-bold text-white flex items-center justify-center gap-4">
                    <!-- <i class="fas fa-moon text-emerald-300"></i> -->
                    বেফাকুল মাদারিসিল আরাবিয়া বাংলাদেশ
                    <!-- <i class="fas fa-moon text-emerald-300"></i> -->
                </h1>

                <h3 class="text-2xl font-bold text-emerald-100 flex items-center justify-center gap-2">
                    <!-- <i class="fas fa-book-quran text-emerald-300"></i> -->
                    (বাংলাদেশ কওমী মাদরাসা শিক্ষাবোর্ড)
                </h3>

                <h3 class="text-2xl font-bold text-emerald-100 flex items-center justify-center gap-2">
                    <i class="fas fa-location-dot text-md text-emerald-300"></i>
                    ২০৫, কাজলার পাড় (ভাঙ্গাপ্রেস), যাত্রাবাড়ী, ঢাকা-১২৩৬
                </h3>
            </div>
        </div>

    </div>
</header>


        <!-- Main Content -->
        <main class="container mx-auto px-4 py-8">
            <!-- Search Form -->
            <div class="bg-white rounded-md shadow-lg p-8 mb-8 border-t-4 border-emerald-800">
    <!-- Header Section -->
    <div class="mb-8 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-emerald-900 flex items-center">

            মারহালাওয়ারী ফলাফল অনুসন্ধান
        </h2>

        <div class="flex gap-4">
            <button
                class="flex items-center gap-2 bg-emerald-800 text-white px-4 py-2 rounded-md hover:bg-emerald-900 transition-all duration-300 shadow-md"
                @click="router.get(route('find_result.studentResultFind'))"
            >
                <i class="fas fa-user-graduate"></i>
                ব্যক্তিগত ফলাফল
            </button>

            <button
                class="flex items-center gap-2 bg-emerald-700 text-white px-4 py-2 rounded-md hover:bg-emerald-800 transition-all duration-300 shadow-md"
                @click="router.get(route('find_result.merit_list'))"
            >
                <i class="fas fa-award"></i>
                মেধা তালিকা
            </button>
        </div>
    </div>

    <!-- Islamic Decorative Divider -->


    <!-- Form Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 items-end">
        <div class="group">
            <label class=" text-emerald-900 mb-3 font-semibold flex items-center">
                <!-- <i class="fas fa-mosque mr-2"></i> -->
                মারহালা নির্বাচন করুন
            </label>
            <select v-model="form.CID"
                class="w-full border-2 border-emerald-100 rounded-md p-2 bg-emerald-50 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
                <option value="">নির্বাচন করুন</option>
                <option v-for="(name, id) in marhalas" :key="id" :value="id">
                    {{ name }}
                </option>
            </select>
        </div>

        <div class="group">
            <label class=" text-emerald-900 mb-3 font-semibold flex items-center">
                <i class="fas fa-calendar-hijri mr-2"></i>
                বছর নির্বাচন করুন
            </label>
            <select v-model="form.years"
                class="w-full  border-emerald-100 rounded-md p-2 bg-emerald-50 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
                <option value="">সন নির্বাচন করুন</option>
                <option v-for="year in availableYears" :key="year" :value="year">{{ year }}</option>
            </select>
        </div>

        <div class="group">
            <label class=" text-emerald-900 mb-3 font-semibold flex items-center">
                <i class="fas fa-id-card-alt mr-2"></i>
                ইলহাক নম্বর দিন
            </label>
            <input v-model="form.MElhaq"
                type="text"
                placeholder="রোল নম্বর লিখুন"
                class="w-full  border-emerald-100 rounded-md p-2 bg-emerald-50 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
        </div>

        <div class="text-right">
            <button @click="search"
                class="bg-emerald-800 text-white px-4 py-2 rounded-md hover:bg-emerald-900 transition-all duration-300 w-full flex items-center justify-center gap-2 shadow-md">
                <i class="fas fa-search"></i>
                ফলাফল খুঁজুন
            </button>
        </div>
    </div>
</div>


            <!-- Results Section -->
<!-- Results Section -->
<div v-if="searchResults?.data?.length > 0" class="bg-white rounded-md shadow-xl p-6 relative">
    <!-- Action Buttons -->
    <div class="absolute top-6 right-6 flex space-x-4">
        <button
    @click="window.print()"
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

    <!-- Madrasa Information -->

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-20 mb-10">
    <!-- Madrasa Information -->
    <div class="space-y-4 bg-emerald-50 p-6 rounded-sm shadow-md">
        <h3 class="text-xl font-bold text-emerald-900 mb-6 flex items-center">
            <i class="fas fa-info-circle mr-2"></i> মাদরাসা তথ্য
        </h3>

        <div class="flex justify-between border-b-2 border-emerald-100 pb-3 text-emerald-900">
            <span class="font-semibold flex items-center">
                <i class="fas fa-school mr-2 text-emerald-700"></i> মাদরাসা নাম:
            </span>
            <span>{{ searchResults.data[0]?.Madrasha }}</span>
        </div>

        <div class="flex justify-between border-b-2 border-emerald-100 pb-3 text-emerald-900">
            <span class="font-semibold flex items-center">
                <i class="fas fa-mosque mr-2 text-emerald-700"></i> মারকাজের নাম:
            </span>
            <span>{{ searchResults.data[0]?.Madrasha }}</span>
        </div>

        <div class="flex justify-between border-b-2 border-emerald-100 pb-3 text-emerald-900">
            <span class="font-semibold flex items-center">
                <i class="fas fa-id-card mr-2 text-emerald-700"></i> ইলহাক:
            </span>
            <span>{{ searchResults.data[0]?.MElhaq }}</span>
        </div>

        <div class="flex justify-between border-b-2 border-emerald-100 pb-3 text-emerald-900">
            <span class="font-semibold flex items-center">
                <i class="fas fa-book-reader mr-2 text-emerald-700"></i> ক্লাস:
            </span>
            <span>{{ searchResults.data[0]?.Class }}</span>
        </div>

        <div class="flex justify-between border-b-2 border-emerald-100 pb-3 text-emerald-900">
            <span class="font-semibold flex items-center">
                <i class="fas fa-calendar-hijri mr-2 text-emerald-700"></i> শিক্ষাবর্ষ:
            </span>
            <span>{{ searchResults.data[0]?.years }}</span>
        </div>
    </div>

    <!-- Result Summary -->
    <div class="bg-emerald-50 p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-bold text-emerald-900 mb-6 flex items-center">
        <i class="fas fa-chart-bar mr-2"></i> ফলাফল সারসংক্ষেপ
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- মূল তথ্য -->
        <div class="space-y-4">
            <div class="flex justify-between text-emerald-900 bg-emerald-100 p-4 rounded-lg">
                <span class="font-semibold flex items-center">
                    <i class="fas fa-users mr-2 text-emerald-700"></i> মোট শিক্ষার্থী
                </span>
                <!-- <span class="text-lg font-bold">{{ totalStudents }} জন</span> -->
            </div>


            <!-- বিভাগভিত্তিক ফলাফল -->
            <div class="bg-white p-4 rounded-lg">
                <h4 class="font-semibold mb-4 text-emerald-800">বিভাগভিত্তিক ফলাফল:</h4>
                <div class="space-y-3">
                    <div v-for="(count, division) in divisionCounts" :key="division"
                        class="flex justify-between items-center">
                        <span class="flex items-center">
                            <i class="fas fa-medal mr-2 text-emerald-600"></i>
                            {{ division }}:
                        </span>
                        <!-- <span class="font-semibold">{{ count }} জন</span> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- শতকরা হার -->
        <div class="space-y-4">
            <div class="bg-white p-4 rounded-lg">
                <h4 class="font-semibold mb-4 text-emerald-800">শতকরা হার:</h4>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="flex items-center">
                            <i class="fas fa-check-circle mr-2 text-green-600"></i>
                            পাশের হার:
                        </span>
                        <span class="font-bold text-green-600">{{ passRate }}%</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center">
                            <i class="fas fa-times-circle mr-2 text-red-600"></i>
                            ফেলের হার:
                        </span>
                        <span class="font-bold text-red-600">{{ failRate }}%</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="flex items-center">
                            <i class="fas fa-user-times mr-2 text-orange-600"></i>
                            অনুপস্থিতির হার:
                        </span>
                        <span class="font-bold text-orange-600">{{ absentRate }}%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>















    <!-- Students Results Table -->
    <div class="overflow-x-auto">
    <table id="resultsTable" class="w-full border-2 border-emerald-100 rounded-md shadow-lg">
        <thead class="bg-emerald-800 text-white">
            <tr>
                <th class="px-6 py-4 text-left"><i class="fas fa-id-card mr-2"></i>ইলহাক</th>
                <th class="px-6 py-4 text-left"><i class="fas fa-user-graduate mr-2"></i>নাম</th>
                <th v-for="(subject, index) in getSubjects(searchResults.data[0])"
                    :key="index"
                    class="px-6 py-4 text-center">
                    {{ subject.name }}
                </th>
                <th class="px-6 py-4 text-center"><i class="fas fa-calculator mr-2"></i>মোট</th>
                <th class="px-6 py-4 text-center"><i class="fas fa-star mr-2"></i>বিভাগ</th>
                <th class="px-6 py-4 text-center"><i class="fas fa-award mr-2"></i>মেধা তালিকা</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-emerald-100">
            <tr v-for="student in searchResults.data" :key="student.id"
                class="hover:bg-emerald-50 transition-colors">
                <td class="px-6 py-4">{{ student.MElhaq }}</td>
                <td class="px-6 py-4">{{ student.Name }}</td>
                <td v-for="(subject, index) in getSubjects(student)"
                    :key="index"
                    class="px-6 py-4 text-center">
                    {{ subject.marks }}
                </td>
                <td class="px-6 py-4 text-center font-bold text-emerald-800">{{ student.Total }}</td>
                <td class="px-6 py-4 text-center font-bold text-emerald-800">{{ student.Division }}</td>
                <td class="px-6 py-4 text-center font-bold text-emerald-800">{{ student.Positions }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Pagination with Islamic Theme -->
    <div class="mt-8 flex items-center justify-center gap-4">
        <!-- Page Size Selector -->
        <div class="flex items-center gap-2">
            <label class="text-sm font-medium text-emerald-800">প্রতি পৃষ্ঠায়:</label>
            <select v-model="pageSize"
                @change="changePageSize"
                class="border-2 border-emerald-100 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500 bg-emerald-50">
                <option :value="10">10</option>
                <option :value="20">20</option>
                <option :value="30">30</option>
                <option :value="50">50</option>
            </select>
        </div>

        <!-- Pagination Controls -->
        <nav class="relative z-0 inline-flex rounded-lg shadow-md" aria-label="Pagination">
            <button @click="fetchPage(1)"
                :disabled="searchResults.current_page === 1"
                class="px-4 py-2 border-2 border-emerald-100 bg-emerald-50 text-emerald-800 text-sm font-medium hover:bg-emerald-100 disabled:opacity-50 disabled:cursor-not-allowed rounded-l-lg flex items-center gap-1">
                <i class="fas fa-angle-double-left"></i> প্রথম
            </button>

            <button @click="fetchPage(searchResults.current_page - 1)"
                :disabled="searchResults.current_page === 1"
                class="px-4 py-2 border-2 border-emerald-100 bg-emerald-50 text-emerald-800 text-sm font-medium hover:bg-emerald-100 disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-1">
                <i class="fas fa-angle-left"></i> পূর্ববর্তী
            </button>

            <span class="px-4 py-2 border-2 border-emerald-100 bg-emerald-50 text-emerald-800 text-sm font-medium">
                পৃষ্ঠা {{ searchResults.current_page }} এর {{ searchResults.last_page }}
            </span>

            <button @click="fetchPage(searchResults.current_page + 1)"
                :disabled="searchResults.current_page >= searchResults.last_page"
                class="px-4 py-2 border-2 border-emerald-100 bg-emerald-50 text-emerald-800 text-sm font-medium hover:bg-emerald-100 disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-1">
                পরবর্তী <i class="fas fa-angle-right"></i>
            </button>

            <button @click="fetchPage(searchResults.last_page)"
                :disabled="searchResults.current_page >= searchResults.last_page"
                class="px-4 py-2 border-2 border-emerald-100 bg-emerald-50 text-emerald-800 text-sm font-medium hover:bg-emerald-100 disabled:opacity-50 disabled:cursor-not-allowed rounded-r-lg flex items-center gap-1">
                শেষ <i class="fas fa-angle-double-right"></i>
            </button>
        </nav>
    </div>
</div>


</div>


<!-- No Results Message -->
<!-- <div v-else-if="searchResults?.data && searchResults.data.length === 0" class="bg-white rounded-md shadow-xl p-6 text-center py-8">
    <p class="text-xl text-gray-600">কোন ফলাফল পাওয়া যায়নি</p>
</div> -->
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
