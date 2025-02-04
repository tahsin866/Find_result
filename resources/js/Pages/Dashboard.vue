<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { Line } from 'vue-chartjs';

const selectedYear = ref('2024');
const selectedExamType = ref('all');
const searchQuery = ref('');
const recentActivities = ref([
    { id: 1, action: 'Result Published', details: 'Class 10 Annual Exam', time: '2 hours ago', user: 'Admin' },
    { id: 2, action: 'Marks Updated', details: 'Roll #2024156', time: '4 hours ago', user: 'Moderator' },
    { id: 3, action: 'Bulk Upload', details: 'Class 8 Term Exam', time: '1 day ago', user: 'Admin' }
]);

const statistics = ref({
    totalStudents: 340000,
    resultsPublished: 2024,
    pendingResults: 150,
    passRate: 85.5,
    topPerformers: 450,
    examsConducted: 12
});

const chartData = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
    datasets: [
        {
            label: 'Pass Rate (%)',
            data: [75, 82, 80, 85, 88, 90],
            borderColor: '#10B981',
            tension: 0.4
        }
    ]
};
</script>

<template>
    <!-- Same structure, updated colors -->
    <AuthenticatedLayout>
      <template #header>
        <div class="flex justify-between items-center bg-[#2C5A63] text-white p-4 rounded-md">
          <h2 class="text-xl font-semibold leading-tight">
            Result Management Dashboard
          </h2>
          <div class="flex gap-4">
            <select v-model="selectedYear" class="rounded-md bg-[#3B7682] text-white border-[#234951]">
              <option value="2024">2024</option>
              <option value="2023">2023</option>
            </select>
            <select v-model="selectedExamType" class="rounded-md bg-[#3B7682] text-white border-[#234951]">
              <option value="all">All Exams</option>
              <option value="annual">Annual</option>
              <option value="term">Term</option>
            </select>
          </div>
        </div>
      </template>

      <div class="py-12 bg-[#F5F7F8]">
        <div class="mx-auto sm:px-6 lg:px-8">
          <!-- Stats Grid -->
          <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <div class="bg-gradient-to-br from-[#2C5A63] to-[#3B7682] shadow-lg rounded-md p-6 transform hover:scale-105 transition-transform">
              <div class="flex items-center">
                <div class="p-3 rounded-md bg-white/20 text-white">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                  </svg>
                </div>
                <div class="ml-4">
                  <p class="text-sm text-white/80">সর্বমোট</p>
                  <p class="text-lg font-semibold text-white">{{ statistics.totalStudents.toLocaleString() }}</p>
                </div>
              </div>
            </div>
            <!-- Repeat for other stat boxes with alternating gradients -->
            <div class="bg-gradient-to-br from-[#2C5A63] to-[#3B7682] shadow-lg rounded-md p-6 transform hover:scale-105 transition-transform">
              <div class="flex items-center">
                <div class="p-3 rounded-md bg-white/20 text-white">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                  </svg>
                </div>
                <div class="ml-4">
                  <p class="text-sm text-white/80">সর্বমোট</p>
                  <p class="text-lg font-semibold text-white">{{ statistics.totalStudents.toLocaleString() }}</p>
                </div>
              </div>
            </div>
            <div class="bg-gradient-to-br from-[#2C5A63] to-[#3B7682] shadow-lg rounded-md p-6 transform hover:scale-105 transition-transform">
              <div class="flex items-center">
                <div class="p-3 rounded-md bg-white/20 text-white">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                  </svg>
                </div>
                <div class="ml-4">
                  <p class="text-sm text-white/80">সর্বমোট</p>
                  <p class="text-lg font-semibold text-white">{{ statistics.totalStudents.toLocaleString() }}</p>
                </div>
              </div>
            </div>
            <div class="bg-gradient-to-br from-[#2C5A63] to-[#3B7682] shadow-lg rounded-md p-6 transform hover:scale-105 transition-transform">
              <div class="flex items-center">
                <div class="p-3 rounded-md bg-white/20 text-white">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                  </svg>
                </div>
                <div class="ml-4">
                  <p class="text-sm text-white/80">সর্বমোট</p>
                  <p class="text-lg font-semibold text-white">{{ statistics.totalStudents.toLocaleString() }}</p>
                </div>
              </div>
            </div>
            <div class="bg-gradient-to-br from-[#2C5A63] to-[#3B7682] shadow-lg rounded-md p-6 transform hover:scale-105 transition-transform">
              <div class="flex items-center">
                <div class="p-3 rounded-md bg-white/20 text-white">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                  </svg>
                </div>
                <div class="ml-4">
                  <p class="text-sm text-white/80">সর্বমোট</p>
                  <p class="text-lg font-semibold text-white">{{ statistics.totalStudents.toLocaleString() }}</p>
                </div>
              </div>
            </div>
            <div class="bg-gradient-to-br from-[#2C5A63] to-[#3B7682] shadow-lg rounded-md p-6 transform hover:scale-105 transition-transform">
              <div class="flex items-center">
                <div class="p-3 rounded-md bg-white/20 text-white">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                  </svg>
                </div>
                <div class="ml-4">
                  <p class="text-sm text-white/80">সর্বমোট</p>
                  <p class="text-lg font-semibold text-white">{{ statistics.totalStudents.toLocaleString() }}</p>
                </div>
              </div>
            </div>
            <div class="bg-gradient-to-br from-[#2C5A63] to-[#3B7682] shadow-lg rounded-md p-6 transform hover:scale-105 transition-transform">
              <div class="flex items-center">
                <div class="p-3 rounded-md bg-white/20 text-white">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                  </svg>
                </div>
                <div class="ml-4">
                  <p class="text-sm text-white/80">সর্বমোট</p>
                  <p class="text-lg font-semibold text-white">{{ statistics.totalStudents.toLocaleString() }}</p>
                </div>
              </div>
            </div>
            <div class="bg-gradient-to-br from-[#2C5A63] to-[#3B7682] shadow-lg rounded-md p-6 transform hover:scale-105 transition-transform">
              <div class="flex items-center">
                <div class="p-3 rounded-md bg-white/20 text-white">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                  </svg>
                </div>
                <div class="ml-4">
                  <p class="text-sm text-white/80">সর্বমোট</p>
                  <p class="text-lg font-semibold text-white">{{ statistics.totalStudents.toLocaleString() }}</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Charts Section -->
          <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-[#2C5A63]">
              <h3 class="text-lg font-semibold mb-4 text-[#2C5A63]">Performance Trends</h3>
              <Line :data="chartData" :options="{ responsive: true }" />
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-[#2C5A63]">
              <h3 class="text-lg font-semibold mb-4 text-[#2C5A63]">Recent Activities</h3>
              <div class="space-y-4">
                <div v-for="activity in recentActivities"
                     class="flex items-center justify-between p-3 hover:bg-[#F0F4F5] rounded-lg border-l-2 border-[#2C5A63]/50">
                  <!-- Activity content -->
                  <div v-for="activity in recentActivities" :key="activity.id"
             class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg">
            <div>
                <p class="font-medium text-gray-800">{{ activity.action }}</p>
                <p class="text-sm text-gray-500">{{ activity.details }}</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500">{{ activity.time }}</p>
                <p class="text-xs text-gray-400">by {{ activity.user }}</p>
            </div>
        </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow-lg rounded-xl p-6 border-t-4 border-[#2C5A63]">
              <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-[#2C5A63]">🔍 Quick Search</h3>
                <span class="text-sm text-[#2C5A63]/70">Real-time</span>
              </div>
              <div class="relative">
                <input type="text"
                       class="w-full rounded-lg border-[#2C5A63]/20 focus:border-[#2C5A63] focus:ring-[#2C5A63] pl-10 pr-4 py-2"
                       placeholder="Search by Roll/Registration No." />
                <!-- Search icon -->
              </div>
            </div>

            <div class="bg-white shadow-lg rounded-xl p-6 border-t-4 border-[#2C5A63]">
              <h3 class="text-lg font-semibold text-[#2C5A63] mb-4">📤 Result Upload</h3>
              <div class="flex flex-col gap-2">
                <button class="bg-[#2C5A63] text-white px-4 py-2 rounded-lg hover:bg-[#234951] flex items-center justify-center gap-2">
                  Bulk Upload
                </button>
                <button class="bg-[#3B7682] text-white px-4 py-2 rounded-lg hover:bg-[#2C5A63] flex items-center justify-center gap-2">
                  Single Entry
                </button>
              </div>
            </div>

            <div class="bg-white shadow-lg rounded-xl p-6 border-t-4 border-[#2C5A63]">
              <h3 class="text-lg font-semibold text-[#2C5A63] mb-4">🎯 Quick Actions</h3>
              <div class="space-y-2">
                <button class="w-full text-left px-4 py-2 rounded-lg hover:bg-[#F0F4F5] flex items-center gap-2 text-[#2C5A63]">
                  <span>📊</span> Generate Reports
                </button>
                <button class="w-full text-left px-4 py-2 rounded-lg hover:bg-[#F0F4F5] flex items-center gap-2 text-[#2C5A63]">
                  <span>📱</span> Send SMS Notifications
                </button>
                <button class="w-full text-left px-4 py-2 rounded-lg hover:bg-[#F0F4F5] flex items-center gap-2 text-[#2C5A63]">
                  <span>📧</span> Email Results
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>

