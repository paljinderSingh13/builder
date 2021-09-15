<template>
  <div class="container mx-auto px-4 w-10/12 mt-10">
    <h1 class="mb-8 font-bold text-3xl text-center">
      Work logs of <span class="capitalize">{{ $page.props.auth.user.first_name }} {{ $page.props.auth.user.last_name }} </span>
    </h1>
    <inertia-link class="float-right block px-6 py-2 hover:bg-indigo-500 hover:text-white text-left" :href="route('logout')">Logout</inertia-link>

    <div class="grid grid-cols-2 gap-4">
      <div class="shadow-tops rounded-t" v-for="(val, key) in logs" :key="key">
        <h3 class="p-4 capitalize text-center bg-gray-400">
          {{ projects[key] }}
        </h3>
        <div class="grid grid-cols-3 bg-gray-100">
          <div class="p-3">From</div>
          <div class="p-3">To</div>
          <div class="p-3">Days</div>
        </div>

        <div class="grid grid-cols-3 bg-white" v-for="next in val" :key="next.id">
          <div class="p-3">{{ date_format(next.start) }}</div>
          <div class="p-3">{{ date_format(next.end) }}</div>
          <div class="p-3">{{ cal_days(next.start, next.end) }}</div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import moment from 'moment'

export default {
  props: {
    logs: Object,
    projects: Object,
  },
  methods: {
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
  },
}
</script>