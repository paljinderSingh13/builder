<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">Reports</h1>

<p>

</p>
  <div class="bg-indigo-800 gap-4 grid grid-cols-3 h-24 py-5 rounded-2xl">
    <div class="ml-4"> <input class="form-input"  type="date" v-model="filters.date" @change="filter()"> </div>
    <div>
       <select class="form-select" @change="userType()" v-model="user_type" >
                <option value="all">All </option>
                 <option value="manager">Manager </option>
                <option value="worker">Worker </option>
        </select>
    </div>
    <div class="mr-4">
      <input placeholder="Search by name" class="form-input" type="text" v-model="name">
    </div>

  </div>

  <div v-if="show_manager" class="grid grid-cols-1 gap-1 m-2">
    <div>
      <h3 class=" font-light text-center m-12   text-5xl"> Manager </h3>


      <h3 class=" font-light text-center m-12   text-xl" v-if="!data.manager">No-manager-data </h3>

      <div class="grid grid-cols-1 bg-indigo-900 " >
            <div class="bg-indigo-800 text-white p-3 m-2" v-for="(item,id) in managerData" :key="id">
              <img v-if="item[0]['user']['photo_path']"  class="w-10 rounded-full inline " :src="path+item[0]['user']['photo_path']" alt="">
              <img v-else  class="w-10 rounded-full inline " :src="path+'users/dummy-profile.png'" alt="">
              {{item[0]['user']['first_name']  }} {{item[0]['user']['last_name']  }}

              <span class="bg-white p-2 mr-2 text-black float-right rounded" v-for="row in item" :key="row.id"> {{ row.project.name }} </span> </div>
      </div>
    </div>
  </div>

  <div v-if="show_worker" class="grid grid-cols-1 gap-1 m-2 ">
    <div>
      <h3 class=" font-light text-center m-12   text-5xl"> Worker </h3>

      <div class="grid grid-cols-1 bg-indigo-900 rounded" >
            <div class="bg-indigo-800 text-white p-3 m-2 rounded" v-for="(item,id) in workerData" :key="id">
              <img v-if="item[0]['user']['photo_path']"  class="w-10 rounded-full inline " :src="path+item[0]['user']['photo_path']" alt="">
              <img v-else  class="w-10 rounded-full inline " :src="path+'users/dummy-profile.png'" alt="">

              {{item[0]['user']['first_name']  }} {{item[0]['user']['last_name']  }}

              <span class="bg-white p-2 mr-2 text-black float-right rounded" v-for="row in item" :key="row.id"> {{ row.project.name }} </span> </div>
      </div>
    </div>
  </div>


  </div>
</template>

<script>
import Layout from '@/Shared/Layout'

export default {
  metaInfo: { title: 'Reports' },
  layout: Layout,
  props:{
    data:Object,
    date:String
  },
  data(){
    return {
        path:'/pingcrm/public/img/',

        filters:{date:this.date},
        user_type:'all',
        name:null,
        show_manager:true,
        show_worker:true
    }

  },
  created(){




   console.log( typeof this.data)
      //  this.data['manager'].filter((item)=>{
      //    console.log(item);
      //  });
  },
  methods:{
    userType(){
      if(this.user_type=='all'){

        this.show_manager = this.show_worker = true;

      }else if(this.user_type=='manager'){

        this.show_manager = true;
        this.show_worker = false;

      }else if(this.user_type=="worker"){

        this.show_manager = false;
        this.show_worker = true;

      }

            },
      filter(){

       // axios.post(route('report.filter'),{date:this.filters.date})
         this.$inertia.post(route('reports',this.filters))
        //  .then(res=>{
        //    console.log(res)
        //  })
    }
  },
  computed:{
    managerData:function(){
      console.log('mdata',this.data.length)
     if(!this.data.manager){
     }else{
      var man= this.data.manager;
      var result = Object.keys(man).map(function (key,val) {

        // Using Number() to convert key to number type
        // Using obj[key] to retrieve key value
       // new_data[Number(key)] = man[Number(key)];
        return man[key];
    });
   return result.filter((row,index)=>{
        if(!this.name){
          return true
        }
        else if(this.name ){
          let fullname = row[0].user.first_name+row[0].user.last_name
          console.log(fullname.toLowerCase() ,fullname.match(this.name.toLowerCase()), this.name.toLowerCase())
          if(fullname.toLowerCase().match(this.name.toLowerCase())){
                return true;
            }else{
                  return false;
          }
        }else{
          return false
        }

    })
     }
   },

   workerData:function(){

     if(!this.data.worker){
     }else{
      var man= this.data.worker;
      var result = Object.keys(man).map(function (key,val) {

        // Using Number() to convert key to number type
        // Using obj[key] to retrieve key value
       // new_data[Number(key)] = man[Number(key)];
        return man[key];
    });
   return result.filter((row,index)=>{
        if(!this.name){
          return true
        }
        else if(this.name ){
          let fullname = row[0].user.first_name+row[0].user.last_name
          console.log(fullname.toLowerCase() ,fullname.match(this.name.toLowerCase()), this.name.toLowerCase())
          if(fullname.toLowerCase().match(this.name.toLowerCase())){
                return true;
            }else{
                  return false;
          }
        }else{
          return false
        }

    })
     }
   }



  }

}
</script>
