<template>
  <div>
    <div class="mb-8 flex justify-start max-w-3xl">
      <h1 class="font-bold text-3xl">
        <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('projects')">Projects</inertia-link>
      </h1>
    </div>

    <div class="bg-white rounded-md shadow overflow-hidden max-w-full">
      <form @submit.prevent="store">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <text-input v-model="form.name" :error="form.errors.name" class="pr-6 pb-8 w-full" label="Project Name * " />

          <text-area v-model="form.address" :error="form.errors.address" class="pr-6 pb-8 w-full" label="Location" />

          <!-- <text-input v-model="form.start_date" type="date" :error="form.errors.start_date" class="pr-6 pb-8 w-full lg:w-1/2" label="Start Date" /> -->
          <!-- <text-input v-model="form.end_date" type="date"  :error="form.errors.end_date" class="pr-6 pb-8 w-full lg:w-1/2" label="End  Date" /> -->

          <text-area v-model="form.detail" :error="form.errors.detail" class="pr-6 pb-8 w-full" label="Detail" />
        </div>
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Add Project</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import TextArea from '@/Shared/TextareaInput'

import LoadingButton from '@/Shared/LoadingButton'

export default {
  metaInfo: { title: 'New Project' },
  layout: Layout,
  components: {
    LoadingButton,
    TextInput,
    TextArea,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        detail: null,
        start_date: null,
        end_date: null,
        address: null,
      }),
    }
  },
  methods: {
    store() {
      this.form.post(this.route('project.store'))
    },
  },
}
</script>
