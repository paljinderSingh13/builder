<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl capitalize">{{ user.user_type }}</h1>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <div class="grid grid-cols-2 border">
        <div class="col-span-2 text-center p-3 text-3xl">
          <img v-if="user.photo_path" :src="path + user.photo_path" class="rounded w-20 h-20 mx-auto" alt="" />
          <img v-else :src="path + 'dummy-profile.png'" class="rounded-full w-20 h-20 mx-auto" alt="" />
        </div>
        <div class="bg-white p-4 border m-1 hover:bg-gray-100 focus-within:bg-gray-100" v-for="(val, key) in user" :key="key" v-if="!exculde_field.includes(key)">
          <span class="inline-block font-medium capitalize" v-if="key != 'date_of_joining'"> {{ key.replace('_', ' ').replace('_', ' ') }} :</span>
          <span class="inline-block font-medium capitalize" v-else> Joining Date :</span>

          {{ val }}
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
    user: Object,
  },
  data() {
    return {
      path: '/public/img/',
      exculde_field: ['id', 'photo_path', 'created_at', 'password', 'account_id', 'owner', 'email_verified_at', 'deleted_at', 'updated_at', 'remember_token'],
    }
  },
}
</script>