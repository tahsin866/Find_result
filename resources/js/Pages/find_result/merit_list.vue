<template>


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
                        <select v-model="form.years"
                            class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#004D40] text-black">
                            <option value="">সন নির্বাচন করুন</option>
                            <option v-for="year in availableYears" :key="year" :value="year">{{ year }}</option>
                        </select>
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-black mb-2 font-semibold">রোল নম্বর</label>
                        <input v-model="form.Roll" type="text" placeholder="রোল নম্বর লিখুন"
                            class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#004D40] text-black">
                    </div>

                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-black mb-2 font-semibold">রেজিস্ট্রেশন নম্বর</label>
                        <input v-model="form.reg_id" type="text" placeholder="রেজিস্ট্রেশন নম্বর লিখুন"
                            class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-[#004D40] text-black">
                    </div>
                    <!-- Continue with other form fields -->
                    <!-- ... -->


                </div>

            </div>



















            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
    <!-- Header with Quick Access Buttons -->
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-[#1a237e]">ব্যক্তিগত ফলাফল অনুসন্ধান</h2>

        <div class="flex gap-4">
            <button
                class="flex items-center gap-2 bg-[#004D40] text-white px-4 py-2 rounded-md hover:bg-[#00695C] transition"
                @click="quickSearch('recent')"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                সর্বশেষ ফলাফল
            </button>

            <button
                class="flex items-center gap-2 bg-[#1a237e] text-white px-4 py-2 rounded-md hover:bg-[#283593] transition"
                @click="quickSearch('popular')"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
                জনপ্রিয় ফলাফল
            </button>
        </div>
    </div>

    <!-- Rest of your existing form content -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Your existing form fields -->
    </div>

    <div class="mt-6 text-right">
                    <button @click="search"
                        class="bg-[#1a237e] text-white px-8 py-2 rounded-md hover:bg-[#283593] transition-colors">
                        ফলাফল খুঁজুন
                    </button>
                </div>
    <!-- Your existing search button -->
</div>

</template>
