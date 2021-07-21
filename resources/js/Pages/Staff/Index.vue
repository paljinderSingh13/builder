<template>
  <div>
    <div class="grid grid-cols-2 mb-6">
      <div class="">
        <h1 class="mb-8 font-bold text-3xl capitalize">{{ user_type }}s</h1>
      </div>

      <div class="mb-6 text-right mr-8 justify-between items-center">
        <inertia-link class="bg-gray-600 p-3 text-white rounded" :href="route('staff.create', user_type)">
          <span>Add</span>
          <span class="hidden md:inline capitalize">{{ user_type }}</span>
        </inertia-link>
      </div>
    </div>

    <div class="bg-white rounded-md shadow-tops overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold bg-gray-100">
          <th class="px-6 pt-6 pb-4">Name</th>
          <th class="px-6 pt-6 pb-4">Email</th>
          <th class="px-6 pt-6 pb-4">Mobile</th>
          <th class="px-6 pt-6 pb-4" colspan="2">Action</th>
        </tr>

        <tr v-for="row in data" :key="row.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t px-6 py-4">
            <span :class="{ 'bg-green-600': row.staff_availablity.length, blues: !row.staff_availablity.length }" class="inline-block rounded-full w-6 h-6 mr-2"> </span>

            <img v-if="row.photo_path" class="inline-block w-10 h-10 rounded-full mr-2" :src="path + row.photo_path" />
            <img v-else class="inline-block w-10 h-8 mr-2 rounded-full" :src="path + 'users/dummy-profile.png'" />
            {{ row.first_name }} {{ row.last_name }}
          </td>
          <td class="border-t">{{ row.email }}</td>
          <td class="border-t">{{ row.mobile }}</td>
          <td class="border-t">
            <inertia-link class="inline-block bg-gray-600 text-white rounded p-2 hover:bg-black hover:text-white" :href="route('users.edit', row.id)" tabindex="-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
              Edit
            </inertia-link>

            <inertia-link class="bg-yellow-300 hover:bg-black hover:text-white inline-block p-2 rounded" :href="route('detail', [user_type, row.id])" tabindex="-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              View
            </inertia-link>
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>
<script>
import Layout from '@/Shared/Layout'
export default {
  metaInfo: { title: 'Add Staff' },

  layout: Layout,
  props: {
    data: Array,
    user_type: String,
  },
  data() {
    return {
      path: '/pingcrm/public/img/',
    }
  },
}
</script>

<style>
.blues {
  background-color: #00008b;
}

.shadow-tops {
  box-shadow: 0px 0px 10px 4px #c6c7caeb;
}
</style>