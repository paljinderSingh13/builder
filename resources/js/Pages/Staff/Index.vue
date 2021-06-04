<template>
<div>
    <h1 class="mb-8 font-bold text-3xl">{{ user_type }}</h1>
    <div class="mb-6 flex justify-between items-center">
        <inertia-link class="btn-indigo" :href="route('staff.create',user_type)">
        <span>Create</span>
            <span class="hidden md:inline">{{ user_type }}</span>
      </inertia-link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
        <table class="w-full whitespace-nowrap">
            <tr class="text-left font-bold">
                <th class="px-6 pt-6 pb-4">Name</th>
                <th class="px-6 pt-6 pb-4">Email</th>
                <th class="px-6 pt-6 pb-4">Mobile</th>
                <th class="px-6 pt-6 pb-4" colspan="2">Action</th>
            </tr>

            <tr v-for="row in data" :key="row.id" class=" hover:bg-gray-100 focus-within:bg-gray-100">
                <td class="border-t px-6 py-4 flex item-center">
                    <img v-if="row.photo" class="block w-10 h-8 mr-2 -my-2" :src="row.photo" />
                    <img v-else class="block w-10 h-8 mr-2 -my-2" src="/img/users/dummy-profile.png" />

                    {{row.name}}

                    </td>
                <td class="border-t"> {{row.email}}</td>
                <td class="border-t"> {{row.mobile}}</td>
                <td class="border-t">
                    <inertia-link class="inline-block" :href="route('users.edit', row.id)" tabindex="-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </inertia-link>

                    <inertia-link class="inline-block" :href="route('detail',[user_type,row.id] )" tabindex="-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </inertia-link>

                </td>


            </tr>
        </table>
    </div>

</div>

</template>
<script>

 import Layout from "@/Shared/Layout";
export default{
layout:Layout,
    props:{
        data:Array,
        user_type:String
    }

}

</script>