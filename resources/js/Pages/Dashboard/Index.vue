<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">Dashboard</h1>
    <div class="grid grid-cols-2 bg-indigo-800">
      <h1 class=" p-3 font-light text-2xl text-white">Latest Projects   </h1>
      <inertia-link class="text-white py-4 text-right mr-4 font-light text-xl " :href="route('projects')"> All Projects ({{ data.project_count }}) </inertia-link>
    </div>


    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full whitespace-nowrap">
            <tr class="text-left font-bold">
                <th class="px-6 pt-6 pb-4">Project Name</th>
                <th class="px-6 pt-6 pb-4">Location</th>

                <th class="px-6 pt-6 pb-4">Start Date</th>
                <th class="px-6 pt-6 pb-4">End Date</th>
                <th class="px-6 pt-6 pb-4">Status</th>
            </tr>

            <tr v-for="row in data['project_data']" :key="row.id" class=" hover:bg-gray-100 focus-within:bg-gray-100">
                <td class="border-t px-6 py-4  item-center">{{row.name}}</td>
                <td class="border-t px-6 py-4  item-center">{{row.address}}</td>

                <td class="border-t"> {{row.start_date}}</td>
                <td class="border-t"> {{row.end_date}}</td>
                <td class="border-t"> <span :class=" {'bg-green-500':(row.status==1),'bg-red-600':(row.status==0) }"
                     class=' p-1 rounded-2xl'>{{(row.status==1?"Active":"In active")}}</span></td>
            </tr>
          </table>
    </div>

    <div class=" grid grid-cols-2 gap-4 mt-12">
      <div >
         <div class="grid grid-cols-2 bg-indigo-800">
          <div class="text-white font-light text-xl p-2"> Manager </div>
          <div class="text-white font-light text-xl p-2">
            <inertia-link :href="route('staff','manager')">
              All manager ({{ data.manager_count }})
            </inertia-link>
          </div>
        </div>

        <div class="grid grid-cols-1 border p-3" v-for="staff in data.manager_data" :key="staff.id">
          <div>
            <span :class="{'bg-green-600':staff.staff_availablity.length,'blues': !staff.staff_availablity.length }" class="inline-block rounded-full w-4 h-4 mr-2 inline-block ml-1"> </span>
            <img v-if="staff.photo_path" class="w-16 h-16 rounded-full inline-block ml-2" :src="path+staff.photo_path" alt="">
            <img v-else class="w-16 h-16 rounded-full inline-block ml-2" :src="path+'users/dummy-profile.png'" alt="">
            <div class="capitalize font-light inline-block ml-2 text-xl inline-block">
              {{staff.first_name}} {{staff.last_name}}
            </div>
          </div>
        </div>


          </div>
       <div >
         <div class="grid grid-cols-2 bg-indigo-800">
          <div class="text-white font-light text-xl p-2"> Worker </div>
          <div class="text-white font-light text-xl p-2">
            <inertia-link :href="route('staff','worker')">
              All Worker ({{ data.worker_count }})
            </inertia-link></div>
        </div>

          <div class="grid grid-cols-1 border p-3" v-for="staff in data.worker_data" :key="staff.id">
          <div>
            <span :class="{'bg-green-600':staff.staff_availablity.length,'blues': !staff.staff_availablity.length }" class="inline-block rounded-full w-4 h-4 mr-2 inline-block ml-1"> </span>
            <img v-if="staff.photo_path" class="w-16 h-16 rounded-full inline-block ml-2" :src="path+staff.photo_path" alt="">
            <img v-else class="w-16 h-16 rounded-full inline-block ml-2" :src="path+'users/dummy-profile.png'" alt="">
            <div class="capitalize font-light inline-block ml-2 text-xl inline-block">
              {{staff.first_name}} {{staff.last_name}}
            </div>
          </div>
        </div>


          </div>
    </div>




  </div>
</template>

<script>
import Layout from '@/Shared/Layout'

export default {
  metaInfo: { title: 'Dashboard' },
  layout: Layout,
  props:{
    data:Object
  },
  data(){
    return {
      path:'/pingcrm/public/img/'
    }
  }
}
</script>
<style>
    .blues {background-color:#00008B;}

</style>
