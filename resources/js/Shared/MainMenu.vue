<template>
  <div class="shadow-2xl black_bg" v-if="$page.props.auth.user.user_type != 'worker'">
    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('dashboard')">
        <icon name="dashboard" class="w-4 h-4 mr-2" :class="isUrl('dashboard') ? 'fill-gray-400' : 'fill-white group-hover:fill-gray-400'" />
        <div :class="isUrl('dashboard') ? 'text-gray-400' : 'text-white group-hover:text-gray-400'">Dashboard</div>
      </inertia-link>
    </div>

    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('reports')">
        <icon name="calendar" class="w-4 h-4 mr-2" :class="isUrl('reports') ? 'fill-gray-400' : 'fill-white group-hover:fill-gray-400'" />
        <div :class="isUrl('reports') ? 'text-gray-400' : 'text-white group-hover:text-gray-400'">Job Calendar</div>
      </inertia-link>
    </div>
    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('status')">
        <icon name="status" class="w-4 h-4 mr-2" :class="isUrl('status') ? 'fill-gray-400' : 'fill-white group-hover:fill-gray-400'" />
        <div :class="isUrl('status') ? 'text-gray-400' : 'text-white group-hover:text-gray-400'">Status</div>
      </inertia-link>
    </div>

    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('staff', 'manager')">
        <icon name="office" class="w-4 h-4 mr-2" :class="isUrl('staff-manager') ? 'fill-gray-400' : 'fill-white group-hover:fill-gray-400'" />
        <div :class="isUrl('staff-manager') ? 'text-gray-400' : 'text-white group-hover:text-gray-400'">Managers</div>
      </inertia-link>
    </div>

    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('staff', 'worker')">
        <icon name="workers" class="w-4 h-4 mr-2" :class="isUrl('staff-worker') ? 'fill-gray-400' : 'fill-white group-hover:fill-gray-400'" />

        <div :class="isUrl('staff-worker') ? 'text-gray-400' : 'text-white group-hover:text-gray-400'">Workers</div>
      </inertia-link>
    </div>

    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('projects')">
        <icon name="project" class="w-4 h-4 mr-2" :class="isUrl('projects') ? 'fill-gray-400' : 'fill-white group-hover:fill-gray-400'" />
        <div :class="isUrl('projects') ? 'text-gray-400' : 'text-white group-hover:text-gray-400'">Projects</div>
      </inertia-link>
    </div>

    <!-- <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('organizations')">
        <icon name="office" class="w-4 h-4 mr-2" :class="isUrl('organizations') ? 'fill-gray-400' : 'fill-white group-hover:fill-gray-400'" />
        <div  :class="isUrl('organizations') ? 'text-gray-400' : 'text-white group-hover:text-gray-400'">Organizations</div>
      </inertia-link>
    </div>
    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('contacts')">
        <icon name="users" class="w-4 h-4 mr-2" :class="isUrl('contacts') ? 'fill-gray-400' : 'fill-white group-hover:fill-gray-400'" />
        <div  :class="isUrl('contacts') ? 'text-gray-400' : 'text-white group-hover:text-gray-400'">Contacts</div>
      </inertia-link>
    </div> -->

    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('project.wise.report')">
        <icon name="report" class="w-4 h-4 mr-2" :class="isUrl('project-report') ? 'fill-gray-400' : 'fill-white group-hover:fill-gray-400'" />
        <div :class="isUrl('project-report') ? 'text-gray-400' : 'text-white group-hover:text-gray-400'">Project Report</div>
      </inertia-link>
    </div>
    <div class="mb-4" v-if="$page.props.auth.user.user_type != 'admin'">
      <inertia-link class="flex items-center group py-3" :href="route('work.log')">
        <icon name="calendar" class="w-4 h-4 mr-2" :class="isUrl('work-log') ? 'fill-gray-400' : 'fill-white group-hover:fill-gray-400'" />
        <div :class="isUrl('work-log') ? 'text-gray-400' : 'text-white group-hover:text-gray-400'">Work Log</div>
      </inertia-link>
    </div>
  </div>
  <div class="shadow-2xl black_bg" v-else>
    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('work.log')">
        <icon name="calendar" class="w-4 h-4 mr-2" :class="isUrl('work-log') ? 'fill-gray-400' : 'fill-white group-hover:fill-gray-400'" />
        <div :class="isUrl('work-log') ? 'text-gray-400' : 'text-white group-hover:text-gray-400'">Work Log</div>
      </inertia-link>
    </div>
  </div>
</template>

<script>
import Icon from '@/Shared/Icon'

export default {
  components: {
    Icon,
  },
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1)
      if (urls[0] === '') {
        return currentUrl === ''
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length
    },
  },
}
</script>

<style>
.black_bg {
  background-color: black !important;
}
</style>
