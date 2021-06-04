<template>
    <div>
    <h1 class="mb-8 font-bold text-3xl">Users </h1>
    <div class="bg-white rounded-md shadow overflow-x-auto">

      <div class="grid grid-cols-2 gap-4 ">
          <div class="bg-white text-black rounded  shadow p-6"
              v-for="(val,key) in user"  :key="key"
              v-if="!exculde_field.includes(key)"
          >
            <span class="w-32 inline-block"> {{key.replace('_',' ').toUpperCase()}} </span>:
            {{ val }}
          </div>



      </div>
      <table class="w-full whitespace-nowrap">

        <tr v-for="(val,key) in user"  :key="key" class="hover:bg-gray-100 focus-within:bg-gray-100">

          <td class="border-t px-6 py-4  items-center focus:text-indigo-500"> {{key.replace('_',' ')}}</td>
          <td class="border-t px-6 py-4  items-center focus:text-indigo-500"> {{val}}</td>

        </tr>
      </table>
    </div>

    </div>
</template>
<script>
import Layout from '@/Shared/Layout'

export default {
layout: Layout,
props: {
    user: Object,
  },
  data(){
    return{
            exculde_field:['id','password','account_id','owner','email_verified_at','deleted_at', 'updated_at','remember_token'],

    }
  }
}
</script>