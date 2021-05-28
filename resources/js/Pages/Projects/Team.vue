<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">Reports Create</h1>












    <div class="grid grid-cols-1 gap-4 ">
        <div class="shadow h-10 p-4 bg-white">  Project name : {{ project.name }} </div>
    </div>

            <h1 class="m-4 fa-3x font-thin p-2"> Manager</h1>

    <div class="grid grid-cols-2 gap-4">

        <div @drop="onDrop($event)"
            @dragenter.prevent
            @dragover.prevent
            class="grid gap-2 grid-cols-1 bg-red-400">
            <div draggable="true" @dragstart="startDrag($event, data, 'out')"  class="bg-black text-white m-2 p-4" v-for="data in user.manager" :key="data.id" v-if="exist_team.includes(data.id)"> {{ data.id }} {{ data.first_name }} {{ data.last_name }} </div>

        </div>


        <div  class="grid gap-2 grid-cols-1 bg-red-400"
            @drop="onDrop($event)"
            @dragenter.prevent
            @dragover.prevent
        >
            <div draggable="true" @dragstart="startDrag($event, data,'in')"  class="bg-black text-white m-2 p-4" v-for="data in user.manager" :key="data.id" v-if="!exist_team.includes(data.id)"> {{ data.id }} {{ data.first_name }} {{ data.last_name }} </div>

        </div>

        {{ exist_team }}
  </div>

              <h1 class="m-4 fa-3x font-thin p-2"> Worker</h1>

    <div class="grid grid-cols-2 gap-4">

        <div @drop="onDrop($event)"
            @dragenter.prevent
            @dragover.prevent
            class="grid gap-2 grid-cols-1 bg-red-400">
            <div draggable="true" @dragstart="startDrag($event, data, 'out')"  class="bg-black text-white m-2 p-4" v-for="data in user.worker" :key="data.id" v-if="exist_team.includes(data.id)"> {{ data.id }} {{ data.first_name }} {{ data.last_name }} </div>

        </div>


        <div  class="grid gap-2 grid-cols-1 bg-red-400"
            @drop="onDrop($event)"
            @dragenter.prevent
            @dragover.prevent
        >
            <div draggable="true" @dragstart="startDrag($event, data,'in')"  class="bg-black text-white m-2 p-4" v-for="data in user.worker" :key="data.id" v-if="!exist_team.includes(data.id)"> {{ data.id }} {{ data.first_name }} {{ data.last_name }} </div>

        </div>

        {{ exist_team }}
  </div>


  </div>
</template>

<script>
import Layout from '@/Shared/Layout'

export default {
  metaInfo: { title: 'Reports' },
  layout: Layout,
  props:{
      project:Object,
      user:Object,
      exist_team:Array
  },
  data(){
      return {
          teams:[],
          include_team:[12,13]
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
