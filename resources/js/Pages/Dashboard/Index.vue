<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">Dashboard</h1>

    <div class="grid grid-cols-2 border bg-white shadow-tops rounded my-8" v-for="project in projects" :key="project.id">
      <div class="col-span-2 p-4 text-center text-2xl bg-gray-100 capitalize">{{ project.name }}</div>
      <div class="p-4 border m-0 hover:bg-gray-100 focus-within:bg-gray-100"><label class="w-1/2 inline-block font-black"> Project Name : </label> {{ project.name }}</div>
      <div class="p-4 border m-0 hover:bg-gray-100 focus-within:bg-gray-100 row-span-3"><label class="w-1/2 font-black"> Project detail : </label>{{ project.detail }}</div>

      <!-- <div class="p-4 border m-0 hover:bg-gray-100 focus-within:bg-gray-100"><label class="w-1/2 font-black"> Start Date: </label>{{ project.start_date }}</div>
      <div class="p-4 border m-0 hover:bg-gray-100 focus-within:bg-gray-100"><label class="w-1/2 inline-block font-black"> End Date : </label>{{ project.end_date }}</div> -->
      <div class="p-4 border m-0 hover:bg-gray-100 focus-within:bg-gray-100 row-span-2"><label class="w-1/2 font-black"> Location : </label>{{ project.address }}</div>
      <div>
        <h3 class="m-4 fa-2x font-thin p-2 text-center mt-10">Managers</h3>
        <div class="grid gap-2 grid-cols-1 bg-white rounded shadow-tops mb-5 mx-5">
          <div class="bg-gray-300 rounded m-2 p-4 h-20" v-for="emp in staff_group_by(project.employee, 'manager')" :key="emp.id">
            <img v-if="emp.photo_path" class="w-10 rounded-full inline" :src="path + emp.photo_path" alt="" />
            <img v-else class="w-10 rounded-full inline" :src="path + 'users/dummy-profile.png'" alt="" />
            {{ emp.first_name }} {{ emp.last_name }}
          </div>
        </div>
      </div>
      <div>
        <h3 class="m-4 fa-2x font-thin p-2 text-center mt-10">Workers</h3>
        <div class="grid gap-2 grid-cols-1 bg-white rounded shadow-tops mb-5 mx-5">
          <div class="bg-gray-300 rounded m-2 p-4 h-20" v-for="emp in staff_group_by(project.employee, 'worker')" :key="emp.id">
            <img v-if="emp.photo_path" class="w-10 rounded-full inline" :src="path + emp.photo_path" alt="" />
            <img v-else class="w-10 rounded-full inline" :src="path + 'users/dummy-profile.png'" alt="" />
            {{ emp.first_name }} {{ emp.last_name }}
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="shadow-tops rounded">
      <div class="grid grid-cols-2 bg-indigo-800 text-gray-600 rounded-t-lg">
        <h1 class="p-3 font-light text-2xl">Latest Projects</h1>
        <inertia-link class="py-4 text-right mr-4 font-light text-xl" :href="route('projects')"> All Projects ({{ data.project_count }}) </inertia-link>
      </div>

      <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full whitespace-nowrap">
          <tr class="text-left font-bold bg-gray-100">
            <th class="px-6 pt-6 pb-4">Project Name</th>
            <th class="px-6 pt-6 pb-4">Location</th>
            <th class="px-6 pt-6 pb-4">Status</th>

            <th class="px-6 pt-6 pb-4">Managers</th>
            <th class="px-6 pt-6 pb-4">Workers</th>
          </tr>

          <tr v-for="row in data['project_data']" :key="row.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="border-t px-6 py-4 item-center">
              <inertia-link class="inline-block items-center" :href="route('project.team', row.id)" tabindex="-1">
                {{ row.name }}
              </inertia-link>
            </td>
            <td class="border-t px-6 py-4 item-center">{{ row.address }}</td>
            <td class="border-t text-center">
              <span :class="{ 'bg-green-500': row.status == 1, 'bg-red-600': row.status == 0 }" class="p-1 rounded-2xl">{{ row.status == 1 ? 'Active' : 'In active' }}</span>
            </td>
            <td class="border-t text-center">{{ row.manager_count }}</td>
            <td class="border-t text-center">{{ row.worker_count }}</td>
          </tr>
        </table>
      </div>
    </div> -->

    <!-- <div class="grid grid-cols-2 gap-4 mt-12">
      <div class="shadow-tops rounded">
        <div class="grid grid-cols-1 bg-indigo-800 rounded-t">
          <div class="font-light text-xl p-3">
            <inertia-link :href="route('staff', 'manager')"> Managers ({{ data.manager_count }}) </inertia-link>
          </div>
        </div>

        <div class="grid grid-cols-4 bg-gray-100 text-center">
          <div class="col-span-3 p-3">Name</div>
          <div class="p-3">Phone</div>
        </div>

        <div class="hover:bg-gray-100 focus-within:bg-gray-100 grid grid-cols-4 border p-3 bg-white" v-for="staff in data.manager_data" :key="staff.id">
          <div class="col-span-3">
            <span :class="{ 'bg-green-600': staff.staff_availablity.length, blues: !staff.staff_availablity.length }" class="inline-block rounded-full w-6 h-6 mr-2 inline-block ml-1"> </span>
            <img v-if="staff.photo_path" class="w-16 h-16 rounded-full inline-block ml-2" :src="path + staff.photo_path" alt="" />
            <img v-else class="w-16 h-16 rounded-full inline-block ml-2" :src="path + 'users/dummy-profile.png'" alt="" />
            <div class="capitalize font-light inline-block ml-2 fa-1x inline-block">{{ staff.first_name }} {{ staff.last_name }}</div>
          </div>
          <div class="fa-1x font-light mt-5 text-center">{{ staff.mobile }}</div>
        </div>
      </div>
      <div class="shadow-tops rounded">
        <div class="grid grid-cols-1 bg-indigo-800 rounded-t">
          <div class="font-light text-xl p-3">
            <inertia-link :href="route('staff', 'worker')"> Workers ({{ data.worker_count }}) </inertia-link>
          </div>
        </div>
        <div class="grid grid-cols-4 bg-gray-100 text-center">
          <div class="col-span-3 p-3">Name</div>
          <div class="p-3">Phone</div>
        </div>

        <div class="hover:bg-gray-100 focus-within:bg-gray-100 grid grid-cols-4 border p-3 bg-white" v-for="staff in data.worker_data" :key="staff.id">
          <div class="col-span-3">
            <span :class="{ 'bg-green-600': staff.staff_availablity.length, blues: !staff.staff_availablity.length }" class="inline-block rounded-full w-6 h-6 mr-2 inline-block ml-1"> </span>
            <img v-if="staff.photo_path" class="w-16 h-16 rounded-full inline-block ml-2" :src="path + staff.photo_path" alt="" />
            <img v-else class="w-16 h-16 rounded-full inline-block ml-2" :src="path + 'users/dummy-profile.png'" alt="" />
            <div class="capitalize font-light inline-block ml-2 fa-1x inline-block">{{ staff.first_name }} {{ staff.last_name }}</div>
          </div>
          <div class="fa-1x font-light mt-5 text-center">{{ staff.mobile }}</div>
        </div>
      </div>
    </div> -->
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'

export default {
  metaInfo: { title: 'Dashboard' },
  layout: Layout,
  props: {
    data: Object,
    projects: Array,
  },
  data() {
    return {
      path: '/pingcrm/public/img/',
    }
  },
  methods: {
    staff_group_by(data, type) {
      return data.filter((row) => row.user_type == type)
    },
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
