<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">  {{ project.name }} Team</h1>

    <div class="grid grid-cols-2 gap-4 bg-white bg-indigo-800 rounded">
        <div class=" p-6 text-white   ">  Project Name : {{ project.name }} </div>
        <div class=" p-6 text-white ">  Project detail : {{ project.detail }} </div>
        <div class=" p-6 text-white ">  Project Address : {{ project.address }} </div>
        <div class=" p-6 text-white ">  Project Start : {{ project.start_date }} </div>
        <div class=" p-6 text-white ">  Project End : {{ project.end_date }} </div>


    </div>

            <h1 class="m-4 fa-3x font-thin p-2 text-center mt-20"> Manager</h1>

    <div class="grid grid-cols-2 gap-4">

        <div @drop="onDrop($event)"
            @dragenter.prevent
            @dragover.prevent
            class="grid gap-2 grid-cols-1 bg-indigo-400 rounded shadow-4xl">
            <div style="" draggable="true" @dragstart="startDrag($event, data, 'out')"  class="bg-indigo-800 rounded text-white m-2 p-4 h-20" v-for="data in user.manager" :key="data.id" v-if="exist_team.includes(data.id)">
                <img v-if="data.photo_path"  class="w-10 rounded-full inline " :src="'/img/'+data.photo_path" alt="">
                <img v-else  class="w-10 rounded-full inline " src="/img/users/dummy-profile.png" alt="">
                  {{ data.first_name }} {{ data.last_name }} </div>

        </div>


        <div  class="grid gap-2 grid-cols-1 bg-indigo-400 rounded shadow-4xl"
            @drop="onDrop($event)"
            @dragenter.prevent
            @dragover.prevent
        >
            <div style="" draggable="true" @dragstart="startDrag($event, data,'in')"  class="bg-indigo-800 rounded text-white m-2 p-4 h-20" v-for="data in user.manager" :key="data.id" v-if="!exist_team.includes(data.id)">
                <img v-if="data.photo_path"  class="w-10 rounded-full inline " :src="'/img/'+data.photo_path" alt="">
                <img v-else  class="w-10 rounded-full inline " src="/img/users/dummy-profile.png" alt="">
                 {{ data.first_name }} {{ data.last_name }} </div>

        </div>

  </div>

              <h1 class="m-4 fa-3x font-thin p-2 text-center mt-20"> Worker</h1>

    <div class="grid grid-cols-2 gap-4">

        <div @drop="onDrop($event)"
            @dragenter.prevent
            @dragover.prevent
            class="grid gap-2 grid-cols-1 bg-indigo-400 rounded shadow-4xl">
            <div style="" draggable="true" @dragstart="startDrag($event, data, 'out')"  class="bg-indigo-800 rounded text-white m-2 p-4 h-20" v-for="data in user.worker" :key="data.id" v-if="exist_team.includes(data.id)">
                <img v-if="data.photo_path"  class="w-10 rounded-full inline " :src="'/img/'+data.photo_path" alt="">
                <img v-else  class="w-10 rounded-full inline " src="/img/users/dummy-profile.png" alt="">                 {{ data.first_name }} {{ data.last_name }}
            </div>

        </div>


        <div  class="grid gap-2 grid-cols-1 bg-indigo-400 rounded shadow-4xl"
            @drop="onDrop($event)"
            @dragenter.prevent
            @dragover.prevent
        >
            <div  draggable="true"
            @dragstart="startDrag($event, data,'in')"
            class="bg-indigo-800 rounded text-white m-2 p-4 h-20"
            v-for="data in user.worker" :key="data.id"
            v-if="!exist_team.includes(data.id) && !occupied_worker.includes(data.id) ">
                <img v-if="data.photo_path"  class="w-10 rounded-full inline " :src="'/img/'+data.photo_path" alt="">
                <img v-else  class="w-10 rounded-full inline " src="/img/users/dummy-profile.png" alt="">

                 {{ data.first_name }} {{ data.last_name }} </div>

        </div>

        <!-- <div v-if="all_occupied" class="bg-indigo-800 rounded text-white m-2 p-4 h-20">No-worker-available </div> -->



  </div>


  </div>
</template>

<script>
import Layout from '@/Shared/Layout'

export default {
  metaInfo: { title: 'Project Team' },
  layout: Layout,
  props:{
      project:Object,
      user:Object,
      exist_team:Array,
      occupied_worker:Object
  },
  data(){
      return {
          teams:[],
          include_team:[12,13],
          all_occupied:true,
      }
  },
  created(){
  },

  methods:{
      startDrag(event, item, type){
        //   console.log(item)
          event.dataTransfer.dragEffect ="move"
          event.dataTransfer.effectAllowed="move"
          event.dataTransfer.setData('itemID',item.id)
          event.dataTransfer.setData('type',type)

      },
      onDrop(event){
           const itemId =  event.dataTransfer.getData('itemID')
            const type =  event.dataTransfer.getData('type')
            if(type=="in"){
                this.exist_team.push(parseInt(itemId))
            }else{
               const index = this.exist_team.indexOf(itemId)
               this.exist_team.splice(index,1)
            }
            this.manage_team(type,itemId);
      },

      manage_team(type, itemId){

 this.$inertia.post(route('sync.team',{"type":type, "project_id":this.project.id, "team":itemId}))

       // this.$inertia.post(route('sync.team',{"type":type, "project_id":this.project.id, "team":this.exist_team}))

      }


  }
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
