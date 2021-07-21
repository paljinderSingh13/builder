<template>
  <div>
    <div class="grid grid-cols-2">
      <h1 class="mb-8 font-bold text-3xl">Projects</h1>
      <div class="mb-6 flex items-center justify-end">
        <inertia-link class="bg-gray-500 p-3 text-white rounded" :href="route('project.create')">
          <span>Add Project</span>
        </inertia-link>
      </div>
    </div>

    <div class="bg-white rounded shadow-tops overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold bg-gray-100">
          <th class="px-6 pt-6 pb-4">Project Name</th>
          <th class="px-6 pt-6 pb-4">Location</th>
          <!-- <th class="px-6 pt-6 pb-4">End Date</th> -->
          <th class="px-6 pt-6 pb-4">Status</th>
          <th class="px-6 pt-6 pb-4" colspan="2">Action</th>
        </tr>

        <tr v-for="row in data" :key="row.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t px-6 py-4 flex item-center">
            {{ row.name }}
          </td>
          <td class="border-t">{{ row.address }}</td>
          <!-- <td class="border-t">{{ row.end_date }}</td> -->
          <td class="border-t text-center">
            <span :class="{ 'bg-green-500 ': row.status == 1, 'bg-red-600': row.status == 0 }" class="p-1">{{ row.status == 1 ? 'Active' : 'In active' }}</span>
          </td>

          <td class="border-t">
            <!-- <inertia-link class="px-4  items-center" :href="route('detail',[user_type,row.id] )" tabindex="-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>
                    </inertia-link>
-->
            <inertia-link class="inline-block btn-indigo px-2 py-1 hover:bg-black hover:text-white" :href="route('project.edit', row.id)" tabindex="-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
              Edit
            </inertia-link>

            <inertia-link class="inline-block bg-yellow-300 rounded px-2 py-1 hover:bg-black hover:text-white" :href="route('project.team', row.id)" tabindex="-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              Team
            </inertia-link>

            <inertia-link class="inline-block bg-gray-500 text-white rounded px-2 py-1 hover:bg-black hover:text-white items-center" :href="route('project.status', [row.id, row.status])" tabindex="-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
              </svg>
              Change Status
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
  metaInfo: { title: 'Projects' },
  layout: Layout,
  props: {
    data: Array,
  },
}
</script>
<style >
.shadow-tops {
  box-shadow: 0px 0px 10px 4px #c6c7caeb;
}
</style>
