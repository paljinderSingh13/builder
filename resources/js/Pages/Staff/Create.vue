<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('staff',type)">Staff</inertia-link>
      <span class="text-indigo-400 font-medium">/</span> {{ type.toUpperCase() }}
    </h1>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-full">
      <form @submit.prevent="store">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <file-input v-model="form.photo" :error="form.errors.photo" class="pr-6 pb-8 w-full lg:w-1/2" type="file" accept="image/*" label="Profile Picture" />
          <text-input v-model="form.employee_id" :error="form.errors.employee_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Employee Id" />

          <text-input v-model="form.first_name" :error="form.errors.first_name" class="pr-6 pb-8 w-full lg:w-1/2" label="First name" />
          <text-input v-model="form.last_name" :error="form.errors.last_name" class="pr-6 pb-8 w-full lg:w-1/2" label="Last name" />

          <text-input v-model="form.mobile" :error="form.errors.mobile" class="pr-6 pb-8 w-full lg:w-1/2" label="Mobile" />
          <text-input v-model="form.emergency_contact" :error="form.errors.emergency_contact" class="pr-6 pb-8 w-full lg:w-1/2" label="Emergency Contact Detail" />

          <text-input type='date' v-model="form.date_of_joining" :error="form.errors.date_of_joining" class="pr-6 pb-8 w-full lg:w-1/2" label="Date Of Joining" />
          <text-input v-model="form.expertise" :error="form.errors.expertise" class="pr-6 pb-8 w-full lg:w-1/2" label="Expertise" />

          <text-input v-model="form.address" :error="form.errors.address" class="pr-6 pb-8 w-full" label="Address" />

          <text-input v-model="form.email" :error="form.errors.email" class="pr-6 pb-8 w-full lg:w-1/2" label="Email" />
          <text-input v-model="form.password" :error="form.errors.password" class="pr-6 pb-8 w-full lg:w-1/2" type="password" autocomplete="new-password" label="Password" />







          <!-- <select-input v-model="form.owner" :error="form.errors.owner" class="pr-6 pb-8 w-full lg:w-1/2" label="Owner">
            <option :value="true">Yes</option>
            <option :value="false">No</option>
          </select-input> -->


        </div>
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create {{type}}</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import FileInput from '@/Shared/FileInput'
import TextInput from '@/Shared/TextInput'
import TextArea from '@/Shared/TextareaInput'

import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  metaInfo: { title: 'Create ' },
  props:{type:String},
  components: {
    FileInput,
    LoadingButton,
    SelectInput,
    TextInput,
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        first_name: null,
        last_name: null,
        email: null,
        password: null,
        owner: false,
        photo: null,
        mobile: null,
        address:null,
        mobile:null,
        employee_id:null,
        expertise:null,
        emergency_contact:null,
        user_type:this.type,
        date_of_joining:null
      }),
    }
  },
  methods: {
    store() {
      this.form.post(this.route('users.store'))
    },
  },
}
</script>
