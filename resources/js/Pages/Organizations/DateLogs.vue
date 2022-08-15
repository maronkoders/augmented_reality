<template>
  <div>
    <Head :title="form.name" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/users_activity">Go Back</Link>
         <span class="text-indigo-400 font-medium">/</span>
       <Link class="text-indigo-400 hover:text-indigo-600" :href="`/users_activity/${form.id}`">{{ form.name }}</Link>
      <span class="text-indigo-400 font-medium">/</span>
        {{moment(date).format('LL')}}
    </h1>
    <!-- <trashed-message  class="mb-6" @restore="restore"> This organization has been deleted. </trashed-message> -->
    <!-- <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Name" />
          <text-input v-model="form.email" :error="form.errors.email" class="pb-8 pr-6 w-full lg:w-1/2" label="Email" />
          <text-input v-model="form.phone" :error="form.errors.phone" class="pb-8 pr-6 w-full lg:w-1/2" label="Phone" />
          <text-input v-model="form.address" :error="form.errors.address" class="pb-8 pr-6 w-full lg:w-1/2" label="Address" />
          <text-input v-model="form.city" :error="form.errors.city" class="pb-8 pr-6 w-full lg:w-1/2" label="City" />
          <text-input v-model="form.region" :error="form.errors.region" class="pb-8 pr-6 w-full lg:w-1/2" label="Province/State" />
          <select-input v-model="form.country" :error="form.errors.country" class="pb-8 pr-6 w-full lg:w-1/2" label="Country">
            <option :value="null" />
            <option value="CA">Canada</option>
            <option value="US">United States</option>
          </select-input>
          <text-input v-model="form.postal_code" :error="form.errors.postal_code" class="pb-8 pr-6 w-full lg:w-1/2" label="Postal code" />
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button v-if="!organization.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete Organization</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Organization</loading-button>
        </div>
      </form>
    </div> -->
    <h2 class="mt-12 text-2xl font-bold">Logs for  {{moment(date).format('LL')}}</h2>
    <div class="mt-6 bg-white rounded shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Time</th>
          <th class="pb-4 pt-6 px-6">IP Address</th>
             <th class="pb-4 pt-6 px-6" >Subject</th>
          <th class="pb-4 pt-6 px-6" >Accessed URL</th>
          <!-- <th class="pb-4 pt-6 px-6">Agent</th> -->

          <!-- <th class="pb-4 pt-6 px-6" >Additional Information</th> -->
        </tr>
        <tr v-for="log in logs" :key="log.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
         <td class="border-t">
            <Link class="flex items-center px-6 py-4" >
              {{ moment(log.created_at).format('LT') }}
            </Link>
          </td>

           <td class="border-t">
            <Link class="flex items-center px-6 py-4"  tabindex="-1"  >
              {{ log.ip_address }}
            </Link>
          </td>


             <td class="border-t">
            <Link class="flex items-center px-6 py-4"  tabindex="-1"  >
              {{ log.subject }}
            </Link>
          </td>

            <td class="border-t">
            <Link class="flex items-center px-6 py-4"  tabindex="-1"  >
              {{ log.url }}
            </Link>
          </td>


          <!-- <td class="border-t">
            <Link class="flex items-center px-6 py-4">
              {{ log.agent }}
            </Link>
          </td> -->




           <!-- <td class="border-t">
            <Link class="flex items-center px-6 py-4"  tabindex="-1">
              {{ log.additional_info ?? '-----' }}
            </Link>
          </td> -->
        </tr>
        <!-- <tr v-if="logs === 0">
          <td class="px-6 py-4 border-t" colspan="4">{{form.name ?? form.email}} has no logs yet.</td>
        </tr> -->
      </table>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'
import moment  from 'moment'

export default {
  components: {
    Head,
    Icon,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    logs: Object,
    user: Object,
    date:Date
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        name: this.user.first_name+" "+this.user.last_name,
        email: this.user.email,
        id: this.user.id
        // phone: this.organization.phone,
        // address: this.organization.address,
        // city: this.organization.city,
        // region: this.organization.region,
        // country: this.organization.country,
        // postal_code: this.organization.postal_code,
      }),
    }
  },
  methods: {
    moment,
    update() {
      this.form.put(`/organizations/${this.organization.id}`)
    },
    destroy() {
      if (confirm('Are you sure you want to delete this organization?')) {
        this.$inertia.delete(`/organizations/${this.organization.id}`)
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this organization?')) {
        this.$inertia.put(`/organizations/${this.organization.id}/restore`)
      }
    },
  },
}
</script>
