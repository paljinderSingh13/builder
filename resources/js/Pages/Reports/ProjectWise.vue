<template>
  <div>
    <select class="form-select mx-auto w-1/2 border-8 border-indigo-800" v-model="project_id" @change="filter()">
      <option value="null">Choose Project</option>
      <option v-for="(name, id) in projects" :value="id" :key="id">{{ name }}</option>
    </select>

    <div v-if="data.name" class="mt-16 border grid grid-cols-2 gap-4">
      <h3 class="col-span-2 text-center p-4 text-2xl">Project Detail</h3>
      <div class="m-2 border p-4 capitalize"><label class="w-1/2 inline-block font-black" for=""> Project Name:</label> {{ data.name }}</div>
      <div class="row-span-2 m-2 border p-4 capitalize"><label class="mb-2 w-1/4 inline-block font-black" for=""> Location:</label> {{ data.address }}</div>
      <!-- <div class="m-2 border p-4 capitalize"><label class="w-1/2 inline-block font-black" for=""> Start Date:</label> {{ data.start_date }}</div>
      <div v-if="data.end_date" class="m-2 border p-4 capitalize"><label class="w-1/2 inline-block font-black" for=""> End Date:</label> {{ data.end_date }}</div> -->
      <div class="row-span-2 m-2 border p-4 capitalize"><label class="w-1/4 mb-2 inline-block font-black" for=""> Detail: </label> {{ data.detail }}</div>
      <div class="m-2 border p-4 capitalize"><label class="w-1/2 inline-block font-black" for=""> Status: </label> {{ data.status == 1 ? 'In Progress' : 'Finish' }}</div>
    </div>

    <div class="grid grid-cols-2 gap-10" v-for="(val, key) in staff" :key="key">
      <h3 class="fa-2x text-center m-10 col-span-full">
        {{ uc_word(key) }}
      </h3>
      <div v-for="(row, index) in val" :key="index">
        <h3 class="p-2 bg-indigo-900 text-white">
          <img v-if="row[0].photo_path" class="w-10 h-10 rounded-full inline" :src="path + row[0].photo_path" alt="" />
          <img v-else class="w-10 h-10 rounded-full inline" :src="path + 'dummy-profile.png'" alt="" />

          {{ row[0].first_name }} {{ row[0].last_name }}
        </h3>
        <div class="grid grid-cols-3 bg-indigo-800 text-white">
          <div class="p-3">From</div>
          <div class="p-3">To</div>
          <div class="p-3">Days</div>
        </div>

        <div class="grid grid-cols-3 bg-indigo-800 text-white" v-for="next in row" :key="next.id">
          <div class="p-3">{{ date_format(next.pivot.start) }}</div>
          <div class="p-3">{{ date_format(next.pivot.end) }}</div>
          <div class="p-3">{{ cal_days(next.pivot.start, next.pivot.end) }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from 'moment'
import Layout from '@/Shared/Layout'

export default {
  metaInfo: { title: 'Reports' },
  layout: Layout,
  props: {
    data: Array,
    projects: Object,
    staff: Array,
  },
  data() {
    return {
      path: '/pingcrm/public/img/',
      project_id: this.data.id ? this.data.id : null,
      moment_data: moment().format('MMMM Do YYYY, h:mm:ss a'),
    }
  },
  methods: {
    filter() {
      this.$inertia.get(route('project.wise.report', this.project_id))
    },
    cal_days(from, to) {
      var b = moment(moment(from).format('YYYY-MM-DD'))
      if (to) {
        var a = moment(moment(to).format('YYYY-MM-DD'))
      } else {
        var a = moment(moment().format('YYYY-MM-DD'))
      }

      return a.diff(b, 'days') + 1
    },
    date_format(date) {
      if (date) {
        return moment(date).format('Do MMMM YYYY')
      } else {
        return 'Active'
      }
    },
    uc_word(word) {
      return word[0].toUpperCase() + word.substring(1)
    },
  },
}
</script>