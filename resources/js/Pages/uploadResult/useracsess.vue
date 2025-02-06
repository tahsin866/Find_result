<script setup>
import { ref, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// Mock data
const users = ref([
  { id: 1, username: 'john_doe', role: 'Admin', permissions: ['read', 'write'], createdAt: '2023-10-01' },
  { id: 2, username: 'jane_doe', role: 'Editor', permissions: ['read'], createdAt: '2023-10-02' },
]);

//   const newUser = ref({
//     username: '',
//     role: '',
//     permissions: [],
//   });

const availableRoles = ['Admin', 'Editor', 'Viewer'];
const availablePermissions = ['read', 'write', 'delete'];

//   const errors = ref({});
const searchQuery = ref('');
const selectedRole = ref('');
const currentPage = ref(1);
const itemsPerPage = 5;
const showDeleteModal = ref(false);
const userIdToDelete = ref(null);

// Computed properties
const filteredUsers = computed(() => {
  return users.value
    .filter(user => user.username.toLowerCase().includes(searchQuery.value.toLowerCase()))
    .filter(user => selectedRole.value ? user.role === selectedRole.value : true)
    .slice((currentPage.value - 1) * itemsPerPage, currentPage.value * itemsPerPage);
});

const totalPages = computed(() => Math.ceil(users.value.length / itemsPerPage));

// Methods
//   const addUser = () => {
//     if (!newUser.value.username) {
//       errors.value.username = 'Username is required.';
//       return;
//     }
//     users.value.push({
//       id: users.value.length + 1,
//       ...newUser.value,
//       createdAt: new Date().toISOString(),
//     });
//     newUser.value = { username: '', role: '', permissions: [] };
//     errors.value = {};
//   };

const updatePermissions = (user, permission) => {
  if (user.permissions.includes(permission)) {
    user.permissions = user.permissions.filter(p => p !== permission);
  } else {
    user.permissions.push(permission);
  }
};

const confirmDelete = (userId) => {
  userIdToDelete.value = userId;
  showDeleteModal.value = true;
};

const deleteUser = () => {
  users.value = users.value.filter(user => user.id !== userIdToDelete.value);
  showDeleteModal.value = false;
};

const newUser = ref({
fullName: '',
username: '',
email: '',
password: '',
confirmPassword: '',
role: 'user',
permissions: []
})

const errors = ref({
fullName: '',
username: '',
email: '',
password: '',
confirmPassword: ''
})

// Add validation logic for the new fields
const validateForm = () => {
let isValid = true
errors.value = {}

if (!newUser.value.fullName) {
  errors.value.fullName = 'Full name is required'
  isValid = false
}

if (!newUser.value.email) {
  errors.value.email = 'Email is required'
  isValid = false
} else if (!isValidEmail(newUser.value.email)) {
  errors.value.email = 'Please enter a valid email address'
  isValid = false
}

if (!newUser.value.password) {
  errors.value.password = 'Password is required'
  isValid = false
} else if (newUser.value.password.length < 8) {
  errors.value.password = 'Password must be at least 8 characters'
  isValid = false
}

if (newUser.value.password !== newUser.value.confirmPassword) {
  errors.value.confirmPassword = 'Passwords do not match'
  isValid = false
}

return isValid
}

const isValidEmail = (email) => {
return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
}

const addUser = () => {
if (validateForm()) {
  users.value.push({
    ...newUser.value,
    id: Date.now(),
    createdAt: new Date().toISOString()
  })
  // Reset form
  newUser.value = {
    fullName: '',
    username: '',
    email: '',
    password: '',
    confirmPassword: '',
    role: 'user',
    permissions: []
  }
  saveToLocalStorage()
}
}




</script>



<template>
    <AuthenticatedLayout>
      <div class="container mx-auto p-6">
        <!-- Add User Form -->
        <div class="bg-white rounded-md shadow-lg p-6 mb-6">
  <h2 class="text-2xl font-bold mb-6 text-gray-800">Add New User</h2>
  <div class="space-y-6">
    <!-- Full Name Input -->
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
      <input
        v-model="newUser.fullName"
        type="text"
        placeholder="Enter full name"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
      >
      <p v-if="errors.fullName" class="mt-2 text-sm text-red-600">{{ errors.fullName }}</p>
    </div>

    <!-- Username Input -->
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
      <input
        v-model="newUser.username"
        type="text"
        placeholder="Enter username"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
      >
      <p v-if="errors.username" class="mt-2 text-sm text-red-600">{{ errors.username }}</p>
    </div>

    <!-- Email Input -->
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
      <input
        v-model="newUser.email"
        type="email"
        placeholder="Enter email address"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
      >
      <p v-if="errors.email" class="mt-2 text-sm text-red-600">{{ errors.email }}</p>
    </div>

    <!-- Password Input -->
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
      <input
        v-model="newUser.password"
        type="password"
        placeholder="Enter password"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
      >
      <p v-if="errors.password" class="mt-2 text-sm text-red-600">{{ errors.password }}</p>
    </div>

    <!-- Confirm Password Input -->
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
      <input
        v-model="newUser.confirmPassword"
        type="password"
        placeholder="Confirm password"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
      >
      <p v-if="errors.confirmPassword" class="mt-2 text-sm text-red-600">{{ errors.confirmPassword }}</p>
    </div>

    <!-- Role Selection -->
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
      <select
        v-model="newUser.role"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
      >
        <option v-for="role in availableRoles" :key="role" :value="role">
          {{ role }}
        </option>
      </select>
    </div>

    <!-- Permissions Selection -->
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-2">Permissions</label>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <label v-for="permission in availablePermissions" :key="permission" class="flex items-center space-x-2">
          <input
            type="checkbox"
            :value="permission"
            v-model="newUser.permissions"
            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
          >
          <span class="text-sm text-gray-600">{{ permission }}</span>
        </label>
      </div>
    </div>

    <!-- Add User Button -->
    <button
      @click="addUser"
      class="w-full sm:w-auto bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-300"
    >
      Add User
    </button>
  </div>
</div>

        <!-- Users List -->
        <div class="bg-white rounded-lg shadow-lg p-6">
          <h2 class="text-2xl font-bold mb-6 text-gray-800">Users</h2>

          <!-- Search and Filter -->
          <div class="mb-6 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
            <input
              v-model="searchQuery"
              type="text"
              placeholder="Search users..."
              class="w-full sm:w-64 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            >
            <select
              v-model="selectedRole"
              class="w-full sm:w-48 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            >
              <option value="">All Roles</option>
              <option v-for="role in availableRoles" :key="role" :value="role">
                {{ role }}
              </option>
            </select>
          </div>

          <!-- Users Table -->
          <div class="space-y-4">
            <div v-for="user in filteredUsers" :key="user.id" class="border rounded-lg p-4 hover:shadow-md transition-shadow">
              <div class="flex justify-between items-start">
                <!-- User Details -->
                <div>
                  <h3 class="text-lg font-semibold text-gray-800">{{ user.username }}</h3>
                  <p class="text-sm text-gray-600">Role: {{ user.role }}</p>
                  <p class="text-sm text-gray-600">Created: {{ new Date(user.createdAt).toLocaleString() }}</p>

                  <!-- Permissions -->
                  <div class="mt-3">
                    <span class="text-sm font-medium text-gray-700">Permissions:</span>
                    <div class="mt-1 flex flex-wrap gap-2">
                      <button
                        v-for="permission in availablePermissions"
                        :key="permission"
                        @click="updatePermissions(user, permission)"
                        :class="[
                          'px-3 py-1 rounded-full text-xs font-medium transition-colors',
                          user.permissions.includes(permission)
                            ? 'bg-green-100 text-green-800 hover:bg-green-200'
                            : 'bg-gray-100 text-gray-800 hover:bg-gray-200'
                        ]"
                      >
                        {{ permission }}
                      </button>
                    </div>
                  </div>
                </div>

                <!-- Delete Button -->
                <button
                  @click="confirmDelete(user.id)"
                  class="text-red-600 hover:text-red-800 transition-colors"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                  </svg>
                </button>
              </div>
            </div>
          </div>

          <!-- Pagination -->
          <div class="mt-6 flex justify-center">
            <button
              v-for="page in totalPages"
              :key="page"
              @click="currentPage = page"
              :class="[
                'mx-1 px-4 py-2 rounded-md text-sm font-medium',
                currentPage === page
                  ? 'bg-indigo-600 text-white'
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              ]"
            >
              {{ page }}
            </button>
          </div>
        </div>

        <!-- Confirmation Modal -->
        <div v-if="showDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
          <div class="bg-white rounded-lg p-6 w-96">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Confirm Deletion</h3>
            <p class="text-sm text-gray-600 mb-6">Are you sure you want to delete this user? This action cannot be undone.</p>
            <div class="flex justify-end space-x-4">
              <button
                @click="showDeleteModal = false"
                class="px-4 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100"
              >
                Cancel
              </button>
              <button
                @click="deleteUser"
                class="px-4 py-2 rounded-md text-sm font-medium text-white bg-red-600 hover:bg-red-700"
              >
                Delete
              </button>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>



  <style scoped>
  /* Add custom styles if needed */
  </style>
