<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl capitalize">{{ project.name }} Team</h1>

    <div class="grid grid-cols-2 border bg-white shadow-tops rounded">
      <div class="col-span-2 p-4 text-center text-2xl bg-gray-100">Project Details</div>
      <div class="p-4 border m-0 hover:bg-gray-100 focus-within:bg-gray-100"><label class="w-1/2 inline-block font-black"> Project Name : </label> {{ project.name }}</div>
      <div class="p-4 border m-0 hover:bg-gray-100 focus-within:bg-gray-100 row-span-3"><label class="w-1/2 font-black"> Project detail : </label>{{ project.detail }}</div>
      <!-- <div class="p-4 border m-0 hover:bg-gray-100 focus-within:bg-gray-100"><label class="w-1/2 font-black"> Start Date: </label>{{ project.start_date }}</div>
      <div class="p-4 border m-0 hover:bg-gray-100 focus-within:bg-gray-100"><label class="w-1/2 inline-block font-black"> End Date : </label>{{ project.end_date }}</div> -->

      <div class="p-4 border m-0 hover:bg-gray-100 focus-within:bg-gray-100 row-span-2"><label class="w-1/2 font-black"> Location : </label>{{ project.address }}</div>
    </div>

    <h1 class="m-4 fa-3x font-thin p-2 text-center mt-20">Managers</h1>

    <div class="grid grid-cols-2 gap-4">
      <div @drop="onDrop($event)" @dragenter.prevent @dragover.prevent class="grid gap-2 grid-cols-1 bg-white shadow-tops rounded">
        <div style="" draggable="true" @dragstart="startDrag($event, data, 'out')" class="bg-gray-300 rounded m-2 p-4 h-20" v-for="data in user.manager" :key="data.id" v-if="exist_team.includes(data.id)">
          <img v-if="data.photo_path" class="w-10 rounded-full inline" :src="path + data.photo_path" alt="" />
          <img v-else class="w-10 rounded-full inline" :src="path + 'users/dummy-profile.png'" alt="" />
          {{ data.first_name }} {{ data.last_name }}
        </div>
      </div>

      <div class="grid gap-2 grid-cols-1 bg-white rounded shadow-tops" @drop="onDrop($event)" @dragenter.prevent @dragover.prevent>
        <div style="" draggable="true" @dragstart="startDrag($event, data, 'in')" class="bg-gray-300 rounded m-2 p-4 h-20" v-for="data in user.manager" :key="data.id" v-if="!exist_team.includes(data.id)">
          <img v-if="data.photo_path" class="w-10 rounded-full inline" :src="path + data.photo_path" alt="" />
          <img v-else class="w-10 rounded-full inline" :src="path + 'users/dummy-profile.png'" alt="" />
          {{ data.first_name }} {{ data.last_name }}
        </div>
      </div>
    </div>

    <h1 class="m-4 fa-3x font-thin p-2 text-center mt-20">Workers</h1>

    <div class="grid grid-cols-2 gap-4">
      <div @drop="onDrop($event)" @dragenter.prevent @dragover.prevent class="grid gap-2 grid-cols-1 bg-white shadow-tops rounded">
        <div style="" draggable="true" @dragstart="startDrag($event, data, 'out')" class="bg-gray-300 rounded m-2 p-4 h-20" v-for="data in user.worker" :key="data.id" v-if="exist_team.includes(data.id)">
          <img v-if="data.photo_path" class="w-10 rounded-full inline" :src="path + data.photo_path" alt="" />
          <img v-else class="w-10 rounded-full inline" :src="path + '/users/dummy-profile.png'" alt="" /> {{ data.first_name }} {{ data.last_name }}
        </div>
      </div>

      <div class="grid gap-2 grid-cols-1 bg-white shadow-tops rounded" @drop="onDrop($event)" @dragenter.prevent @dragover.prevent>
        <!-- eslint-disable -->

        <div draggable="true" @dragstart="startDrag($event, data, 'in')" class="bg-gray-300 rounded m-2 p-4 h-20" v-for="data in user.worker" :key="data.id" v-if="!exist_team.includes(data.id) && !occupied_worker.includes(data.id)">
          <img v-if="data.photo_path" class="w-10 rounded-full inline" :src="path + data.photo_path" alt="" />
          <img v-else class="w-10 rounded-full inline" :src="path + 'users/dummy-profile.png'" alt="" />

          {{ data.first_name }} {{ data.last_name }}
        </div>
      </div>
      <!-- eslint-enable -->

      <!-- <div v-if="all_occupied" class="bg-indigo-800 rounded text-white m-2 p-4 h-20">No-worker-available </div> -->
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'

export default {
  metaInfo: { title: 'Project Team' },
  layout: Layout,
  props: {
    project: Object,
    user: Object,
    exist_team: Array,
    occupied_worker: Array,
  },
  data() {
    return {
      path: '/public/img/',
      teams: [],
      include_team: [12, 13],
      all_occupied: true,
    }
  },
  created() {},

  methods: {
    startDrag(event, item, type) {
      //   console.log(item)
      event.dataTransfer.dragEffect = 'move'
      event.dataTransfer.effectAllowed = 'move'
      event.dataTransfer.setData('itemID', item.id)
      event.dataTransfer.setData('type', type)
    },
    onDrop(event) {
      const itemId = event.dataTransfer.getData('itemID')
      const type = event.dataTransfer.getData('type')
      if (type == 'in') {
        this.exist_team.push(parseInt(itemId))
      } else {
        const index = this.exist_team.indexOf(itemId)
        this.exist_team.splice(index, 1)
      }
      this.manage_team(type, itemId)
    },

    manage_team(type, itemId) {
      this.$inertia.post(route('sync.team', { type: type, project_id: this.project.id, team: itemId }))

      // this.$inertia.post(route('sync.team',{"type":type, "project_id":this.project.id, "team":this.exist_team}))
    },
    occupied_check_not_included(id) {
      // v-if="!exist_team.includes(data.id) && !occupied_worker.includes(data.id) ">

      if (!exist_team.includes(id) && !this.occupied_worker.includes(id)) {
        return true
      } else {
        return false
      }
    },
  },
  //   setup(){

  //       const startDrag = (event, item)=>{
  //           console.log(item)
  //       }
  //       return{
  //           startDrag,
  //       }

  //   },
}
</script>
<style >
.shadow-tops {
  box-shadow: 0px 0px 10px 4px #c6c7caeb;
}
</style>
