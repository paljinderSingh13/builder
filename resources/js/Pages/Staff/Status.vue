<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">Status</h1>
    <div class="grid grid-cols-2 gap-4 mt-12">
      <div class="shadow-tops rounded">
        <div class="grid grid-cols-1 bg-indigo-800 rounded-t">
          <div class="font-light text-xl p-3">
            <inertia-link :href="route('staff', 'manager')"> Managers ({{ data.manager.length }})</inertia-link>
          </div>
        </div>

        <div class="grid grid-cols-4 bg-gray-100 text-center">
          <div class="col-span-3 p-3">Name</div>
          <div class="p-3">Phone</div>
        </div>

        <div class="hover:bg-gray-100 focus-within:bg-gray-100 grid grid-cols-4 border p-3 bg-white" v-for="staff in data.manager" :key="staff.id">
          <div class="col-span-3">
            <span :class="{ 'bg-green-600': parseInt(staff.staff_availablity_count), blues: !parseInt(staff.staff_availablity_count) }" class="inline-block rounded-full w-6 h-6 mr-2 inline-block ml-1"> </span>
            <img v-if="staff.photo_path" class="w-16 h-16 rounded-full inline-block ml-2" :src="path + staff.photo_path" alt="" />
            <img v-else class="w-16 h-16 rounded-full inline-block ml-2" :src="path + 'users/dummy-profile.png'" alt="" />
            <div class="capitalize font-light inline-block ml-2 fa-1x inline-block">{{ staff.first_name }} {{ staff.last_name }}</div>
          </div>
          <div class="fa-1x font-light mt-5 text-center">{{ staff.mobile }}</div>
          <!-- <div></div> -->
        </div>
      </div>
      <div class="shadow-tops rounded">
        <div class="grid grid-cols-1 bg-indigo-800 rounded-t">
          <div class="font-light text-xl p-3">
            <inertia-link :href="route('staff', 'worker')"> Workers ({{ data.worker.length }}) </inertia-link>
          </div>
        </div>
        <div class="grid grid-cols-4 bg-gray-100 text-center">
          <div class="col-span-3 p-3">Name</div>
          <div class="p-3">Phone</div>
        </div>

        <div class="hover:bg-gray-100 focus-within:bg-gray-100 grid grid-cols-4 border p-3 bg-white" v-for="staff in data.worker" :key="staff.id">
          <div class="col-span-3">
            <span :class="{ 'bg-green-600': parseInt(staff.staff_availablity_count), blues: !parseInt(staff.staff_availablity_count) }" class="inline-block rounded-full w-6 h-6 mr-2 inline-block ml-1"> </span>
            <img v-if="staff.photo_path" class="w-16 h-16 rounded-full inline-block ml-2" :src="path + staff.photo_path" alt="" />
            <img v-else class="w-16 h-16 rounded-full inline-block ml-2" :src="path + 'users/dummy-profile.png'" alt="" />
            <div class="capitalize font-light inline-block ml-2 fa-1x inline-block">{{ staff.first_name }} {{ staff.last_name }}</div>
          </div>
          <div class="fa-1x font-light mt-5 text-center">{{ staff.mobile }}</div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Layout from '@/Shared/Layout'

export default {
  layout: Layout,
  props: {
    data: Object,
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