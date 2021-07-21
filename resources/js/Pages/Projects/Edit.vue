<template>
  <div>
    <div class="mb-8 flex justify-start max-w-3xl">
      <h1 class="font-bold text-3xl">
        <inertia-link class="text-gray-500 hover:text-gray-600" :href="route('projects')">Projects</inertia-link>
        <span class="text-indigo-400 font-medium">/</span>
        {{ form.name }}
      </h1>
    </div>
    <trashed-message v-if="data.deleted_at" class="mb-6" @restore="restore"> This Project has been deleted. </trashed-message>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-full">
      <form @submit.prevent="update">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="form.name" :error="form.errors.name" class="pr-6 pb-8 w-full" label="Project Name" />

          <text-area v-model="form.address" :error="form.errors.address" class="pr-6 pb-8 w-full" label="Address" />

          <!-- <text-input v-model="form.start_date" type="date" :error="form.errors.start_date" class="pr-6 pb-8 w-full lg:w-1/2" label="Start Date" /> -->
          <!-- <text-input v-model="form.end_date" type="date"  :error="form.errors.end_date" class="pr-6 pb-8 w-full lg:w-1/2" label="End  Date" /> -->

          <text-area v-model="form.detail" :error="form.errors.detail" class="pr-6 pb-8 w-full" label="Detail" />
        </div>
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center">
          <button v-if="!data.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete Project</button>

          <inertia-link tabindex="4" class="bg-yellow-300 hover:bg-black hover:text-white p-2 ml-auto ml-auto py-3 rounded mr-2" :href="route('projects')"> Back To Projects</inertia-link>

          <loading-button :loading="form.processing" class="bg-gray-500 text-white rounded p-3" type="submit">Update Project</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import FileInput from '@/Shared/FileInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'
import TextArea from '@/Shared/TextareaInput'

export default {
  metaInfo() {
    return {
      title: `Edit ${this.form.name} `,
    }
  },
  components: {
    FileInput,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
    TextArea,
  },
  layout: Layout,
  props: {
    data: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        name: this.data.name,
        address: this.data.address,
        start_date: this.data.start_date,
        end_date: this.data.end_date,
        // owner: this.user.owner,
        detail: this.data.detail,
      }),
    }
  },
  methods: {
    update() {
      this.form.post(this.route('project.update', this.data.id))
    },
    destroy() {
      if (confirm('Are you sure you want to delete this project?')) {
        this.$inertia.delete(this.route('project.destroy', this.data.id))
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this project?')) {
        this.$inertia.put(this.route('project.restore', this.data.id))
      }
    },
  },
}
</script>
