<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, computed } from 'vue';
import axios from 'axios';
import { router } from '@inertiajs/vue3'


defineProps({
  filteredResults: {
    type: Array,
    required: true,
    default: () => []
  }
});

// State variables
const selectedExam = ref('');
const selectedLevel = ref('');
const selectedClass = ref('');
const uploadFile = ref(null);
const resultsPreview = ref([]);
const fileInput = ref(null);



// Handle file selection
const handleFileUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        uploadFile.value = file;
    }
};

// Upload results
const uploadResults = async () => {
    const formData = new FormData();
    formData.append('file', uploadFile.value);
    formData.append('exam_year', selectedExam.value);
    formData.append('level', selectedLevel.value);
    // formData.append('class', selectedClass.value);

    router.post('/uploadResult/resultUpload', formData, {
        forceFormData: true,
        preserveScroll: true,
        preserveState: true,
        onBefore: () => {
            // Show loading state
        },
        onSuccess: () => {
            alert('Results uploaded successfully');
            resetForm();
        },
        onError: (errors) => {
            alert('Error uploading results: ' + Object.values(errors).join('\n'));
        }
    });
};




const resetForm = () => {
    uploadFile.value = null;
    selectedExam.value = '';
    selectedLevel.value = '';
    selectedClass.value = '';
    resultsPreview.value = [];
    if (fileInput.value) {
        fileInput.value.value = '';
    }
};

// Filter results
const filteredResults = computed(() => {
    if (!selectedClass.value) return resultsPreview.value;
    return resultsPreview.value.filter(result => result.class === selectedClass.value);
});
</script>

<template>
    <AuthenticatedLayout>
        <div class="mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-semibold text-[#2C5A63] mb-4">
                📤 বাল্ক রেজাল্ট আপলোড এবং মেনেজমেন্ট সিস্টেম
            </h2>

            <!-- Exam, Level & Class Selection -->
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[#2C5A63] font-medium mb-1">পরীক্ষার বছর নির্বাচন করুন</label>
                    <select v-model="selectedExam"
                            class="w-full p-2 border-[#2C5A63]/20 rounded-md focus:border-[#2C5A63] focus:ring-[#2C5A63]">
                        <option value="">পরীক্ষা নির্বাচন করুন</option>
                        <option value="48">৪৮ তম কেন্দ্রীয় পরীক্ষা</option>
                        <option value="47">৪৭ তম কেন্দ্রীয় পরীক্ষা</option>
                        <option value="46">৪৬ তম কেন্দ্রীয় পরীক্ষা</option>
                        <option value="45">৪৫ তম কেন্দ্রীয় পরীক্ষা</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[#2C5A63] font-medium mb-1">মারহালা নির্বাচন করুন</label>
                    <select v-model="selectedLevel"
                            class="w-full p-2 border-[#2C5A63]/20 rounded-md focus:border-[#2C5A63] focus:ring-[#2C5A63]">
                        <option value="">মারহালা নির্বাচন করুন</option>
                        <option value="fazilat">ফযিলত</option>
                        <option value="sanabiya_ulya">সানাবিয়া উলইয়া</option>
                        <option value="sanabiya">সানাবিয়া</option>
                        <option value="mutawassita">মুতাওয়াসসিতা</option>
                        <option value="ibtedaiyah">ইবতেদাইয়্যাহ</option>
                        <option value="hifzul_quran">হিফজুল কোরান</option>
                        <option value="ilmut_tajwid">ইলমুত তাজবিদ ওয়াল কিরাত</option>
                    </select>
                </div>


            </div>

            <!-- File Upload -->
            <div class="border-2 border-dashed border-[#2C5A63]/30 p-6 rounded-lg text-center">
                <input
                    type="file"
                    ref="fileInput"
                    @change="handleFileUpload"
                    accept=".csv,.xlsx,.xls"
                    class="hidden"
                />
                <p class="text-[#2C5A63]/70 mb-2">CSV/Excel ফাইল আপলোড করুন</p>
                <button
                    class="bg-[#2C5A63] text-white px-4 py-2 rounded-md hover:bg-[#3B7682]"
                    @click="fileInput.click()"
                    type="button"
                >
                    ফাইল নির্বাচন করুন
                </button>
                <p v-if="uploadFile" class="text-[#2C5A63] mt-2">
                    {{ uploadFile.name }} সফলভাবে আপলোড হয়েছে ✅
                </p>
            </div>

            <!-- Results Preview -->
           <div v-if="filteredResults.length > 0" class="mt-6">
    <h3 class="text-lg font-semibold text-[#2C5A63] mb-3">📊 ফলাফল প্রিভিউ</h3>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white shadow-md rounded-lg">
        <thead>
          <tr class="bg-[#2C5A63] text-white">
            <th class="p-2">রোল</th>
            <th class="p-2">নাম</th>
            <th class="p-2">শ্রেণী</th>
            <th class="p-2">পরীক্ষার বছর</th>
            <th class="p-2">লেভেল</th>
            <th class="p-2">নম্বর</th>
            <th class="p-2">ফলাফল</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="result in filteredResults"
              :key="result.id"
              class="border-t hover:bg-[#2C5A63]/5">
            <td class="p-2 text-center">{{ result.roll }}</td>
            <td class="p-2 text-center">{{ result.student_name }}</td>
            <td class="p-2 text-center">{{ result.class }}</td>
            <td class="p-2 text-center">{{ result.exam_year }}</td>
            <td class="p-2 text-center">{{ result.level }}</td>
            <td class="p-2 text-center">{{ result.marks }}</td>
            <td class="p-2 text-center font-semibold"
                :class="result.status === 'Pass' ? 'text-green-600' : 'text-red-600'">
              {{ result.status }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

            <!-- Submit Button -->
            <div class="mt-6 text-right">
                <button
                    @click="uploadResults"
                    class="bg-[#2C5A63] text-white px-6 py-2 rounded-md hover:bg-[#3B7682]"
                    :disabled="!uploadFile">
                    ফলাফল আপলোড করুন
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
