<template>
    <div>
    <h1 class="mb-8 font-bold text-3xl">Users </h1>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">

        <tr v-for="(val,key) in user"  class="hover:bg-gray-100 focus-within:bg-gray-100">

          <td class="border-t"> {{key}}</td>
          <td class="border-t py-2"> {{val}}</td>

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
}
</script>