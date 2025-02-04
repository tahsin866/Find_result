<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref,computed  } from 'vue';

// State variables
const selectedExam = ref('');
const selectedLevel = ref('');
const selectedClass = ref('');
const uploadFile = ref(null);
const resultsPreview = ref([]);
const resultType = ref('regular');
const isEditing = ref(false);
const editingResult = ref(null);

// Class options based on level
const classOptions = computed(() => {
    if (selectedLevel.value === 'dakhil') {
        return ['Class 6', 'Class 7', 'Class 8', 'Class 9', 'Class 10'];
    } else if (selectedLevel.value === 'alim') {
        return ['Class 11', 'Class 12'];
    }
    return [];
});

// Handle file selection
const handleFileUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        uploadFile.value = file;
        // Simulated file processing (for preview)
        resultsPreview.value = [
            { id: 1, roll: '101', name: 'Ahmed Ali', marks: 85, status: 'Pass', class: 'Class 6' },
            { id: 2, roll: '102', name: 'Fatima Rahman', marks: 74, status: 'Pass', class: 'Class 7' },
            { id: 3, roll: '103', name: 'Omar Hossain', marks: 40, status: 'Fail', class: 'Class 8' },
        ];
    }
};

// Handle file drop
const handleDrop = (event) => {
    event.preventDefault();
    handleFileUpload({ target: { files: event.dataTransfer.files } });
};

// Edit result
const editResult = (result) => {
    editingResult.value = { ...result };
    isEditing.value = true;
};

// Update result
const updateResult = () => {
    const index = resultsPreview.value.findIndex(r => r.id === editingResult.value.id);
    if (index !== -1) {
        // Update status based on marks
        editingResult.value.status = editingResult.value.marks >= 50 ? 'Pass' : 'Fail';
        resultsPreview.value[index] = { ...editingResult.value };
    }
    isEditing.value = false;
    editingResult.value = null;
};

// Filter results by class
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
            <div class="mb-4 grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-[#2C5A63] font-medium mb-1">পরীক্ষার বছর নির্বাচন করুন</label>
                    <select v-model="selectedExam" class="w-full p-2 border-[#2C5A63]/20 rounded-md focus:border-[#2C5A63] focus:ring-[#2C5A63]">
                        <option value="">পরীক্ষা নির্বাচন করুন</option>
                        <option value="annual">৪৮ তম কেন্দ্রীয় পরীক্ষা</option>
                        <option value="annual">৪৭ তম কেন্দ্রীয় পরীক্ষা</option>
                        <option value="monthly">৪৬ তম কেন্দ্রীয় পরীক্ষা</option>
                        <option value="monthly">৪৫ তম কেন্দ্রীয় পরীক্ষা</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[#2C5A63] font-medium mb-1">মারহালা নির্বাচন করুন</label>
                    <select v-model="selectedLevel" class="w-full p-2 border-[#2C5A63]/20 rounded-md focus:border-[#2C5A63] focus:ring-[#2C5A63]">
                        <option value="">মারহালা নির্বাচন করুন</option>
                        <option value="dakhil">ফযিলত</option>
                        <option value="alim">সানাবিয়া উলইয়া</option>
                        <option value="alim">সানাবিয়া</option>
                        <option value="alim">মুতাওয়াসসিতা</option>
                        <option value="alim">ইবতেদাইয়্যাহ</option>
                        <option value="alim">হিফজুল কোরান</option>
                        <option value="alim">ইলমুত তাজবিদ ওয়াল কিরাত</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[#2C5A63] font-medium mb-1">Select Class</label>
                    <select v-model="selectedClass" class="w-full p-2 border-[#2C5A63]/20 rounded-md focus:border-[#2C5A63] focus:ring-[#2C5A63]">
                        <option value="">All Classes</option>
                        <option v-for="(className, index) in classOptions" :key="index" :value="className">
                            {{ className }}
                        </option>
                    </select>
                </div>
            </div>

            <!-- Result Type Selection -->
            <div class="mb-4">
                <label class="block text-[#2C5A63] font-medium mb-1">Result Type</label>
                <div class="flex gap-4">
                    <button
                        class="px-4 py-2 rounded-md text-white"
                        :class="resultType === 'regular' ? 'bg-[#2C5A63]' : 'bg-gray-400'"
                        @click="resultType = 'regular'">
                        Regular
                    </button>
                    <button
                        class="px-4 py-2 rounded-md text-white"
                        :class="resultType === 'nazareSani' ? 'bg-[#3B7682]' : 'bg-gray-400'"
                        @click="resultType = 'nazareSani'">
                        Nazare Sani
                    </button>
                </div>
            </div>

            <!-- File Upload -->
            <div
                class="border-2 border-dashed border-[#2C5A63]/30 p-6 rounded-lg text-center cursor-pointer hover:border-[#2C5A63]/70"
                @dragover.prevent
                @drop="handleDrop">
                <input type="file" class="hidden" @change="handleFileUpload" accept=".csv,.xlsx,.xls" />
                <p class="text-[#2C5A63]/70">Drag & drop a CSV/Excel file here or</p>
                <button class="mt-2 bg-[#2C5A63] text-white px-4 py-2 rounded-md hover:bg-[#3B7682]">
                    Select File
                </button>
                <p v-if="uploadFile" class="text-[#2C5A63] mt-2">
                    {{ uploadFile.name }} uploaded successfully ✅
                </p>
            </div>

            <!-- Results Preview -->
            <div v-if="filteredResults.length > 0" class="mt-6">
                <h3 class="text-lg font-semibold text-[#2C5A63] mb-3">📊 Results Preview</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md rounded-lg border-[#2C5A63]/10">
                        <thead>
                            <tr class="bg-[#2C5A63] text-white">
                                <th class="p-2">Roll No</th>
                                <th class="p-2">Student Name</th>
                                <th class="p-2">Class</th>
                                <th class="p-2">Exam</th>
                                <th class="p-2">Marks</th>
                                <th class="p-2">Status</th>
                                <th class="p-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="result in filteredResults" :key="result.id" class="border-t hover:bg-[#2C5A63]/5">
                                <td class="p-2 text-center">{{ result.roll }}</td>
                                <td class="p-2 text-center">{{ result.name }}</td>
                                <td class="p-2 text-center">{{ result.class }}</td>
                                <td class="p-2 text-center">{{ result.marks }}</td>
                                <td class="p-2 text-center font-semibold"
                                    :class="result.status === 'Pass' ? 'text-[#2C5A63]' : 'text-red-600'">
                                    {{ result.status }}
                                </td>
                                <td class="p-2 text-center">
                                    <button
                                        @click="editResult(result)"
                                        class="bg-[#3B7682] text-white px-3 py-1 rounded-md hover:bg-[#2C5A63]">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Edit Modal -->
            <div v-if="isEditing" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg w-96 border-t-4 border-[#2C5A63]">
                    <h3 class="text-lg font-semibold mb-4 text-[#2C5A63]">Edit Result</h3>
                    <div class="mb-4">
                        <label class="block text-[#2C5A63] mb-2">Marks</label>
                        <input
                            type="number"
                            v-model="editingResult.marks"
                            class="w-full p-2 border-[#2C5A63]/20 rounded-md focus:border-[#2C5A63] focus:ring-[#2C5A63]"
                            min="0"
                            max="100"
                        />
                    </div>
                    <div class="flex justify-end gap-2">
                        <button
                            @click="isEditing = false"
                            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                            Cancel
                        </button>
                        <button
                            @click="updateResult"
                            class="bg-[#2C5A63] text-white px-4 py-2 rounded-md hover:bg-[#3B7682]">
                            Update
                        </button>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 text-right">
                <button
                    class="bg-[#2C5A63] text-white px-6 py-2 rounded-md hover:bg-[#3B7682]"
                    :disabled="!uploadFile">
                    Upload & Publish Results
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
