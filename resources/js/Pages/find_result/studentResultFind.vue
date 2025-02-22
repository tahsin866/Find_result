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



const form = ref({
    CID: '',
    years: '',
    Roll: '',
    reg_id: ''
});





const getSubjectCount = (student) => {
    let count = 0;
    for (let i = 1; i <= 8; i++) {
        if (student[`SubLabel_${i}`]) count++;
    }
    return count || 8; // Default to 8 if count is 0
};


// const getGrade = (marks, grace) => {
//     if (!marks) return 'N/A';

//     // Ensure marks and grace are numeric
//     const numericMarks = Number(marks);
//     const numericGrace = Number(grace) || 0;

//     // Add grace value to marks
//     const totalMarks = numericMarks + numericGrace;

//     if (totalMarks >= 80) return 'মুমতাজ';
//     if (totalMarks >= 70) return 'জায়্যিদ জিদ্দান';
//     if (totalMarks >= 60) return 'জায়্যিদ';
//     if (totalMarks >= 33) return 'মকবুল';
//     return 'ফেল';
// }


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



// const downloadCertificate = (student) => {
//     const url = route('find_result.student_result.pdf', {
//         Roll: student.Roll,
//         reg_id: student.reg_id,
//         action: 'D'
//     });
//     window.location.href = url;
// };

// const printCertificate = (student) => {
//     const url = route('find_result.student_result.pdf', {
//         Roll: student.Roll,
//         reg_id: student.reg_id,
//         action: 'I'
//     });
//     window.open(url, '_blank');
// };


const quickSearch = (type) => {
    if (type === 'recent') {
        router.get(route('find_result.marhalawariFindResult'));
    }
    // ... other conditions
};


</script>





<template>

    <Head title="ফলাফল" />

    <div style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="min-h-screen bg-gray-50">
        <!-- Header -->
        <header class="bg-emerald-900">
    <!-- Islamic Geometric Pattern Top -->
    <div class="" style="background-image: url('path-to-islamic-pattern.png')"></div>

    <div class="container mx-auto px-6 py-8">
        <div class="flex flex-col items-center">
            <!-- Arabic Bismillah -->


            <!-- Main Content -->
            <div class="w-full text-center space-y-6">
                <!-- Decorative Border Start -->
                <div class="flex justify-center mb-4">
                    <div class="border-2 border-emerald-300/30 p-1 rounded-lg">
                        <div class="border-2 border-emerald-300/30 px-8 py-4 rounded-lg">
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
                        <h3 class="px-4 bg-gradient-to-r from-emerald-900 to-emerald-800 text-2xl font-bold text-emerald-100">
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
        <main class="container mx-auto px-4 py-8">
            <!-- Search Form -->
            <div class="bg-white rounded-md shadow-lg p-8 mb-8 border-t-4 border-emerald-800">
    <!-- Header with Quick Access Buttons -->
    <div class="mb-8 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-emerald-900 flex items-center">

            ব্যক্তিগত ফলাফল অনুসন্ধান
        </h2>

        <div class="flex gap-4">
            <button
                class="flex items-center gap-2 bg-emerald-800 text-white px-5 py-2 rounded-md hover:bg-emerald-900 transition-all duration-300 shadow-md"
                @click="router.get(route('find_result.marhalawariFindResult'))"
            >
                <i class="fas fa-book-quran"></i>
                মারহালাওয়ারী ফলাফল
            </button>

            <button
                class="flex items-center gap-2 bg-emerald-700 text-white px-5 py-2 rounded-md hover:bg-emerald-800 transition-all duration-300 shadow-md"
                @click="router.get(route('find_result.merit_list'))"
            >
                <i class="fas fa-award"></i>
                মেধা তালিকা
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="group">
            <label class=" text-emerald-900 mb-3 font-semibold flex items-center group-hover:text-emerald-700 transition-colors">
                <i class="fas fa-mosque mr-2 text-emerald-700"></i>
                মারহালা নির্বাচন করুন
            </label>
            <select v-model="form.CID"
                class="w-full border-2 border-emerald-100 rounded-md p-2 bg-emerald-50 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
                <option value="">নির্বাচন করুন</option>
                <option v-for="(name, id) in marhalas" :key="id" :value="id">{{ name }}</option>
            </select>
        </div>

        <div class="group">
            <label class=" text-emerald-900 mb-3 font-semibold flex items-center group-hover:text-emerald-700 transition-colors">
                <i class="fas fa-calendar-hijri mr-2 text-emerald-700"></i>
                বছর নির্বাচন করুন
            </label>
            <select v-model="form.years"
                class="w-full border-2 border-emerald-100 rounded-md p-2 bg-emerald-50 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
                <option value="">সন নির্বাচন করুন</option>
                <option v-for="year in availableYears" :key="year" :value="year">{{ year }}</option>
            </select>
        </div>

        <div class="group">
            <label class=" text-emerald-900 mb-3 font-semibold flex items-center group-hover:text-emerald-700 transition-colors">
                <i class="fas fa-id-card mr-2 text-emerald-700"></i>
                রোল নম্বর
            </label>
            <input v-model="form.Roll" type="text"
                placeholder="রোল নম্বর লিখুন"
                class="w-full border-2 border-emerald-100 rounded-lg p-2 bg-emerald-50 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
        </div>

        <div class="group">
            <label class=" text-emerald-900 mb-3 font-semibold flex items-center group-hover:text-emerald-700 transition-colors">
                <i class="fas fa-scroll mr-2 text-emerald-700"></i>
                রেজিস্ট্রেশন নম্বর
            </label>
            <input v-model="form.reg_id" type="text"
                placeholder="রেজিস্ট্রেশন নম্বর লিখুন"
                class="w-full  border-emerald-100 rounded-md p-2 bg-emerald-50 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300">
        </div>
    </div>

    <div class="mt-8 flex justify-end">
        <button @click="search"
            class="bg-emerald-800 text-white px-8 py-2 rounded-md hover:bg-emerald-900 transition-all duration-300 flex items-center gap-2 shadow-md">
            <i class="fas fa-search"></i>
            ফলাফল খুঁজুন
        </button>
    </div>
</div>


            <!-- Results Section -->
            <div v-for="student in searchResults.data" :key="student.id" class="bg-white p-8 rounded-lg shadow-lg border-t-4 border-emerald-800">
    <!-- Action Buttons -->
    <div class="flex justify-end gap-4 mb-8">
        <button @click="printCertificate(student)"
            class="flex items-center gap-2 bg-emerald-800 text-white px-6 py-2 rounded-md hover:bg-emerald-900 transition-all duration-300 shadow-md">
            <i class="fas fa-print text-lg"></i>
            প্রিন্ট করুন
        </button>

        <button @click="downloadCertificate(student)"
            class="flex items-center gap-2 bg-emerald-700 text-white px-6 py-2 rounded-md hover:bg-emerald-800 transition-all duration-300 shadow-md">
            <i class="fas fa-download text-lg"></i>
            ডাউনলোড করুন
        </button>
    </div>

    <!-- Islamic Decorative Divider -->
    <!-- <div class="flex justify-center mb-8">
        <div class="flex items-center gap-4">
            <i class="fas fa-star-and-crescent text-emerald-600"></i>
            <div class="h-0.5 w-32 bg-emerald-200"></div>
            <i class="fas fa-mosque text-emerald-600"></i>
            <div class="h-0.5 w-32 bg-emerald-200"></div>
            <i class="fas fa-star-and-crescent text-emerald-600"></i>
        </div>
    </div> -->

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Student Information -->
        <div class="space-y-4 bg-emerald-50 p-6 rounded-md">
            <h3 class="text-xl font-bold text-emerald-900 mb-6 flex items-center">
                <i class="fas fa-user-graduate mr-2"></i> ছাত্র তথ্য
            </h3>
            <div class="space-y-4">
                <div class="flex justify-between border-b-2 border-emerald-100 pb-3 text-emerald-900">
                    <span class="font-semibold flex items-center"><i class="fas fa-user mr-2"></i> নাম:</span>
                    <span class="font-semibold">{{ student.Name }}</span>
                </div>
                <div class="flex justify-between border-b-2 border-emerald-100 pb-3 text-emerald-900">
                    <span class="font-semibold flex items-center"><i class="fas fa-user mr-2"></i> পিতার নাম:</span>
                    <span class="font-semibold">{{ student.Father }}</span>
                </div>

                <div class="flex justify-between border-b-2 border-emerald-100 pb-3 text-emerald-900">
    <span class="font-semibold flex items-center">
        <i class="fas fa-calendar-day mr-2 text-emerald-700"></i> জন্ম-তারিখ:
    </span>
    <span class="font-semibold">{{ student.DateofBirth }}</span>
</div>


                <div class="flex justify-between border-b-2 border-emerald-100 pb-3 text-emerald-900">
                    <span class="font-semibold flex items-center"><i class="fas fa-school mr-2"></i> মাদরাসার নাম:</span>
                    <span class="font-semibold">{{ student.Madrasha }}</span>
                </div>

                <div class="flex justify-between border-b-2 border-emerald-100 pb-3 text-emerald-900">
                    <span class="font-semibold flex items-center"><i class="fas fa-school mr-2"></i> মারকাযের নাম:</span>
                    <span class="font-semibold">{{ student.Markaj }}</span>
                </div>

                <div class="flex justify-between border-b-2 border-emerald-100 pb-3 text-emerald-900">
                    <span class="font-semibold flex items-center"><i class="fas fa-hashtag mr-2"></i> রোল নম্বর:</span>
                    <span class="font-semibold">{{ student.Roll }}</span>
                </div>

                <div class="flex justify-between border-b-2 border-emerald-100 pb-3 text-emerald-900">
                    <span class="font-semibold flex items-center"><i class="fas fa-hashtag mr-2"></i> রেজিস্ট্রেশন নম্বর:</span>
                    <span class="font-semibold">{{ student.reg_id }}</span>
                </div>
            </div>
        </div>

        <!-- Result Summary -->
        <div class="bg-emerald-50 p-6 rounded-ম">
            <h3 class="text-xl font-bold text-emerald-900 mb-6 flex items-center">
                <i class="fas fa-award mr-2"></i> ফলাফল সারসংক্ষেপ
            </h3>
            <div class="space-y-4">
    <div class="flex justify-between text-emerald-900">
        <span class="font-semibold flex items-center">
            <i class="fas fa-calculator mr-2 text-emerald-700"></i> মোট নম্বর:
        </span>
        <span>{{ student.Total }}</span>
    </div>

    <div class="flex justify-between text-emerald-900">
        <span class="font-semibold flex items-center">
            <i class="fas fa-trophy mr-2 text-emerald-700"></i> মেধা তালিকা:
        </span>
        <span>{{ student.Positions }}</span>
    </div>

    <div class="flex justify-between text-emerald-900">
        <span class="font-semibold flex items-center">
            <i class="fas fa-chart-line mr-2 text-emerald-700"></i> গঢ় নম্বর:
        </span>
        <span>{{ student.Total/8}}</span>
    </div>
    <div class="flex justify-between text-emerald-900">
    <span class="font-semibold flex items-center">
        <i class="fas fa-award mr-2 text-emerald-700"></i> গ্রেস প্রাপ্ত কিতাবের নাম:
    </span>
    <span>{{ student.GraceLabel }}</span>
</div>

<div class="flex justify-between text-emerald-900">
    <span class="font-semibold flex items-center">
    <i class="fas fa-star-half-alt mr-2 text-emerald-700"></i> গ্রেস প্রাপ্ত নম্বর:
    </span>
    <span>{{ student.GraceValue }}</span>
</div>

</div>

        </div>
    </div>

    <!-- Detailed Marks -->
    <div class="mt-8">
        <h3 class="text-xl font-bold text-emerald-900 mb-6 flex items-center">
            <i class="fas fa-book-open mr-2"></i> বিস্তারিত নম্বর
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-emerald-100">
                    <tr class="text-emerald-900">
                        <th class="px-6 py-4 text-left">বিষয়</th>
                        <th class="px-6 py-4 text-center">পূর্ণমান</th>
                        <th class="px-6 py-4 text-center">প্রাপ্ত নম্বর</th>
                        <!-- <th class="px-6 py-4 text-center">গ্রেড</th> -->
                    </tr>
                </thead>
                <tbody class="divide-y divide-emerald-100">
                    <tr v-for="index in getSubjectCount(student)" :key="index"
                        class="text-emerald-900 hover:bg-emerald-50 transition-colors">
                        <td class="px-6 py-4">{{ student[`SubLabel_${index}`] }}</td>
                        <td class="px-6 py-4 text-center">১০০</td>
                        <td class="px-6 py-4 text-center font-semibold">{{ student[`SubValue_${index}`] }}</td>
                        <!-- <td class="px-6 py-4 text-center font-semibold">{{ getGrade(student[`SubValue_${index}`]) }}</td> -->
                    </tr>
                </tbody>
            </table>
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
