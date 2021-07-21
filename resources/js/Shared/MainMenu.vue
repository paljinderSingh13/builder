<template>
  <div class="shadow-2xl">
    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('dashboard')">
        <icon name="dashboard" class="w-4 h-4 mr-2" :class="isUrl('') ? 'fill-gray-800' : 'fill-gray-500 group-hover:fill-gray-800'" />
        <div :class="isUrl('') ? 'text-gray-800' : 'text-indigo-300 group-hover:text-gray-800'">Dashboard</div>
      </inertia-link>
    </div>

    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('staff', 'manager')">
        <icon name="office" class="w-4 h-4 mr-2" :class="isUrl('staff-manager') ? 'fill-gray-800' : 'fill-gray-500 group-hover:fill-gray-800'" />
        <div :class="isUrl('staff-manager') ? 'text-gray-800' : 'text-indigo-300 group-hover:text-gray-800'">Managers</div>
      </inertia-link>
    </div>

    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('staff', 'worker')">
        <icon name="workers" class="w-4 h-4 mr-2" :class="isUrl('staff-manager') ? 'fill-gray-800' : 'fill-gray-500 group-hover:fill-gray-800'" />

        <div :class="isUrl('staff-worker') ? 'text-gray-800' : 'text-indigo-300 group-hover:text-gray-800'">Workers</div>
      </inertia-link>
    </div>

    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('projects')">
        <icon name="project" class="w-4 h-4 mr-2" :class="isUrl('projects') ? 'fill-gray-800' : 'fill-gray-500 group-hover:fill-gray-800'" />
        <div :class="isUrl('projects') ? 'text-gray-800' : 'text-indigo-300 group-hover:text-gray-800'">Projects</div>
      </inertia-link>
    </div>

    <!-- <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('organizations')">
        <icon name="office" class="w-4 h-4 mr-2" :class="isUrl('organizations') ? 'fill-gray-800' : 'fill-gray-500 group-hover:fill-gray-800'" />
        <div :class="isUrl('organizations') ? 'text-gray-800' : 'text-indigo-300 group-hover:text-gray-800'">Organizations</div>
      </inertia-link>
    </div>
    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('contacts')">
        <icon name="users" class="w-4 h-4 mr-2" :class="isUrl('contacts') ? 'fill-gray-800' : 'fill-gray-500 group-hover:fill-gray-800'" />
        <div :class="isUrl('contacts') ? 'text-gray-800' : 'text-indigo-300 group-hover:text-gray-800'">Contacts</div>
      </inertia-link>
    </div> -->
    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('reports')">
        <icon name="calendar" class="w-4 h-4 mr-2" :class="isUrl('reports') ? 'fill-gray-800' : 'fill-gray-500 group-hover:fill-gray-800'" />
        <div :class="isUrl('reports') ? 'text-gray-800' : 'text-indigo-300 group-hover:text-gray-800'">Date Reports</div>
      </inertia-link>
    </div>

    <div class="mb-4">
      <inertia-link class="flex items-center group py-3" :href="route('project.wise.report')">
        <icon name="report" class="w-4 h-4 mr-2" :class="isUrl('project-report') ? 'fill-gray-800' : 'fill-gray-500 group-hover:fill-gray-800'" />
        <div :class="isUrl('project-report') ? 'text-gray-800' : 'text-indigo-300 group-hover:text-gray-800'">Project Report</div>
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
