<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';



// Update the props definition
const props = defineProps({
    canLogin: {
        type: Boolean,
        default: false
    },
    canRegister: {
        type: Boolean,
        default: false
    },
    availableYears: Array,
    marhalas: Object,
    SRtype: Object,
    searchResults: Object,
    studentDetails: Object,
    auth: Object,
    errors: Object
});



const searchResults = ref(props.searchResults || { data: [], last_page: 1 });

const studentDetails = props.studentDetails || {};

const form = ref({
    CID: '',
    years: '',
    Roll: '',
    reg_id: '',
     // Add this property
});



// const getSubjects = (student) => {
//   const subjects = [];
//   for (let i = 1; i <= 8; i++) {
//     if (student[`SubLabel_${i}`]) {
//       subjects.push({
//         name: student[`SubLabel_${i}`],
//         marks: student[`SubValue_${i}`]
//       });
//     }
//   }
//   return subjects;
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



const pageSize = ref(10);
const currentPage = ref(1);

// Modified changePageSize function
const changePageSize = () => {
    currentPage.value = 1; // Reset to first page
    fetchResults(); // Fetch with new page size
};

// New consolidated fetch function
const fetchResults = () => {
    router.get(route('find_result.merit_list'), {
        CID: form.value.CID,
        years: form.value.years,

        page: currentPage.value,
        per_page: pageSize.value
    }, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: (response) => {
            searchResults.value = response.props.searchResults;
        }
    });
};

// Modified fetchPage function
const fetchPage = (page) => {
    currentPage.value = page;
    fetchResults();
};



// Update the search function to include pagination params
const search = () => {
    if (!form.value.CID) {
        alert('মারহালা নির্বাচন করুন');
        return;
    }
    if (!form.value.SRtype) {
        alert('ছাত্র-ছাত্রী নির্বাচন করুন');
        return;
    }

    router.get(route('find_result.merit_list'), {
        CID: form.value.CID,
        SRtype: form.value.SRtype,
        years: form.value.years,
        page: currentPage.value,
        per_page: pageSize.value
    }, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: (response) => {
            searchResults.value = response.props.searchResults;
            console.log('Search Results:', response.props.searchResults);
        }
    });
};














const quickSearch = (type) => {
    if (type === 'recent') {
        router.get(route('find_result.merit_list'));
    }
    // ... other conditions
};


</script>





<template>
    <Head title="ফলাফল" />

    <div style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="min-h-screen bg-gray-50">
        <!-- Header -->
        <header class="bg-[#2C5A63] shadow-lg">
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
                    class="bg-white text-[#727D73] px-6 py-2 rounded hover:bg-gray-100 transition-colors"
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


                <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-[#00695C]">মেধাওয়ারী ফলাফল অনুসন্ধান</h2>

        <div class="flex gap-4">
            <button
    class="flex items-center gap-2 bg-[#004D40] text-white px-4 py-2 rounded-md hover:bg-[#2C5A63] transition"
    @click="router.get(route('find_result.marhalawariFindResult'))"
>
<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
   মারহালাওয়ারী ফলাফল
</button>



            <button
    class="flex items-center gap-2 bg-[#004D40] text-white px-4 py-2 rounded-md hover:bg-[#2C5A63] transition"
    @click="router.get(route('find_result.studentResultFind'))"
>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
        />
    </svg>
    ব্যক্তিগত ফলাফল
</button>



            <button
    class="flex items-center gap-2 bg-[#2C5A63] text-white px-4 py-2 rounded-md hover:bg-[#2C5A63] transition"
    @click="quickSearch('popular')"
>
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"
        />
    </svg>
    মেধা তালিকা
</button>

        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 items-end">
        <div>
            <label class="block text-black mb-2 font-semibold">বছর নির্বাচন করুন</label>
            <select v-model="form.years" class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#004D40] text-black">
                <option value="">সন নির্বাচন করুন</option>
                <option v-for="year in availableYears" :key="year" :value="year">{{ year }}</option>
            </select>
        </div>

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
            <label class="block text-gray-700 mb-2 font-semibold">ছাত্র-ছাত্রী নির্বাচন করুন</label>
            <select v-model="form.SRtype" class="w-full border rounded-md p-2">
                <option value="">নির্বাচন করুন</option>
                <option v-for="(name, id) in SRtype" :key="id" :value="id">
                    {{ name }}
                </option>
            </select>
        </div>

        <div class="text-right">
            <button @click="search" class="bg-[#00695C] text-white px-8 py-2 rounded-md hover:bg-[#00695C] transition-colors w-full">
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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-20 mb-10">

        <div class="space-y-4">
            <div class="flex justify-between border-b pb-2 text-black">
                <span class="font-semibold">মাদরাসা  নাম:</span>
                <span>{{ searchResults.data[0]?.Madrasha }}</span>
            </div>
            <div class="flex justify-between border-b pb-2 text-black">
                <span class="font-semibold">ইলহাক:</span>
                <span>{{ searchResults.data[0]?.MElhaq }}</span>
            </div>
            <div class="flex justify-between border-b pb-2 text-black">
                <span class="font-semibold">ক্লাস:</span>
                <span>{{ searchResults.data[0]?.Class }}</span>
            </div>
            <div class="flex justify-between border-b pb-2 text-black">
                <span class="font-semibold">শিক্ষাবর্ষ:</span>
                <span>{{ searchResults.data[0]?.years }}</span>
            </div>
            <!-- <div class="flex justify-between border-b pb-2 text-black">
                <span class="font-semibold">মাদরাসার নাম:</span>
                <span>{{ student.Madrasha }}</span>
            </div> -->
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
                        <span>{{ searchResults.data[0]?.Madrasha }}</span>
                    </div>
                    <div class="flex justify-between text-black">
                        <span class="font-semibold">শতকরা হার:</span>
                        <span>{{ searchResults.data[0]?.Madrasha }}</span>
                    </div>
                    <div class="flex justify-between text-black">
                        <span class="font-semibold">বিভাগ:</span>
                        <span class="font-bold">{{ searchResults.data[0]?.Madrasha }}</span>
                    </div>

                    <div class="flex justify-between text-black">
                        <span class="font-semibold">মেধা তালিকা:</span>
                        <span class="font-bold">{{ searchResults.data[0]?.Positions }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Students Results Table -->
    <div class="overflow-x-auto">
    <table id="resultsTable" class="w-full border border-gray-200 rounded-md">
      <thead class="bg-gray-50 text-black">
        <tr>
          <th class="px-4 py-2 text-left">ইলহাক</th>
          <th class="px-4 py-2 text-left">নাম</th>
          <th class="px-4 py-2 text-left">রোল নম্বর</th>
          <th class="px-4 py-2 text-left">মাদরাসার নাম</th>
          <th class="px-4 py-2 text-center">মোট</th>
          <th class="px-4 py-2 text-center">বিভাগ</th>
          <th class="px-4 py-2 text-center">মেধা তালিকা</th>
        </tr>
      </thead>
      <tbody class="divide-y text-black font-semibold">
        <tr v-for="student in searchResults.data" :key="student.id">
          <td class="px-4 py-2">{{ student.MElhaq }}</td>
          <td class="px-4 py-2">{{ student.Name }}</td>
          <td class="px-4 py-2">{{ student.Roll }}</td>
          <td class="px-4 py-2">{{ student.Madrasha }}</td>
          <td class="px-4 py-2 text-center">{{ student.Total }}</td>
          <td class="px-4 py-2 text-center">{{ student.Division }}</td>
          <td class="px-4 py-2 text-center font-bold">{{ student.Positions }}</td>
        </tr>
      </tbody>
    </table>
  </div>
    <!-- Pagination -->
    <div class="mt-8 flex items-center justify-center gap-4">
    <!-- Page Size Selector -->
    <div class="flex items-center gap-2">
        <label class="text-sm font-medium text-gray-700">প্রতি পৃষ্ঠায়:</label>
        <select
            v-model="pageSize"
            @change="changePageSize"
            class="border border-gray-300 rounded-md px-2 py-1 text-sm focus:ring-2 focus:ring-[#004D40]"
        >
            <option :value="10">10</option>
            <option :value="20">20</option>
            <option :value="30">30</option>
            <option :value="50">50</option>
        </select>
    </div>

    <!-- Pagination Controls -->
    <nav class="relative z-0 inline-flex rounded-md shadow-sm" aria-label="Pagination">
        <!-- First Page Button -->
        <button
            @click="fetchPage(1)"
            :disabled="searchResults.current_page === 1"
            class="px-4 py-2 border border-gray-300 bg-white text-sm font-medium hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed rounded-l-md"
        >
            প্রথম
        </button>

        <!-- Previous Page Button -->
        <button
            @click="fetchPage(searchResults.current_page - 1)"
            :disabled="searchResults.current_page === 1"
            class="px-4 py-2 border border-gray-300 bg-white text-sm font-medium hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
        >
            পূর্ববর্তী
        </button>

        <!-- Page Info -->
        <span class="px-4 py-2 border border-gray-300 bg-white text-sm font-medium">
            পৃষ্ঠা {{ searchResults.current_page }} এর {{ searchResults.last_page }}
        </span>

        <!-- Next Page Button -->
        <button
            @click="fetchPage(searchResults.current_page + 1)"
            :disabled="searchResults.current_page >= searchResults.last_page"
            class="px-4 py-2 border border-gray-300 bg-white text-sm font-medium hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
        >
            পরবর্তী
        </button>

        <!-- Last Page Button -->
        <button
            @click="fetchPage(searchResults.last_page)"
            :disabled="searchResults.current_page >= searchResults.last_page"
            class="px-4 py-2 border border-gray-300 bg-white text-sm font-medium hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed rounded-r-md"
        >
            শেষ
        </button>
    </nav>
</div>


</div>

<!-- No Results Message -->
<div v-else-if="searchResults?.data && searchResults.data.length === 0" class="bg-white rounded-md shadow-xl p-6 text-center py-8">
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
