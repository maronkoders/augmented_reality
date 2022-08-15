<template>
  <div>
    <Head title="Subjects" />
    <h1 class="mb-8 text-3xl font-bold">School Subjects</h1>
    <div class="flex items-center justify-between mb-6">
      <!-- <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
        <label class="block text-gray-700">Trashed:</label>
        <select v-model="form.trashed" class="form-select mt-1 w-full">
          <option :value="null" />
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
      </search-filter> -->
      <Link class="btn-indigo" href="/subjects/create">
        <span>Create</span>
        <span class="hidden md:inline">&nbsp;subjects</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <thead>
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6">Name</th>
              <th class="pb-4 pt-6 px-6">Level Name</th>
            <th class="pb-4 pt-6 px-6" colspan="2">Created at</th>
            <!-- <th class="pb-4 pt-6 px-6" colspan="2">Action</th> -->
          </tr>
        </thead>
        <tbody>
          <tr v-for="(level,i) in subjects.data" :key="i" class="hover:bg-gray-100 focus-within:bg-gray-100">

           <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/subjects/${level.id}`">
                {{ level.name }}
              </Link>
            </td>

             <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/subjects/${level.id}`">
                {{ level.level.name }}
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/subjects/${level.id}`">
                {{ moment(level.created_at).fromNow() }}
              </Link>
            </td>
            <td class="w-px border-t">
              <Link class="flex items-center px-4" :href="`/subjects/${level.id}`">

                <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
              </Link>
            </td>
          </tr>
          <tr v-if="subjects.length === 0">
            <td class="px-6 py-4 border-t" colspan="4">No subjects  found.</td>
          </tr>
        </tbody>
      </table>
    </div>

  <pagination class="mt-6" :links="subjects.links" />
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination'
import SearchFilter from '@/Shared/SearchFilter'
import moment from "moment"
import axios from 'axios'

export default {
  components: {
    Head,
    Icon,
    Link,
    Pagination,
    SearchFilter
  },
  layout: Layout,
  props: {
    filters: Object,
     subjects: Array,
  },
  data() {
    return {
      timer:"",
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/subjects', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
   created() {
    // this.getUsers();
  },
  methods: {
    moment,
    getUsers()
    {
      axios.get('http://localhost:8000/api/v1/getLogs')
      .then((data) =>{
               if(data.data.status == "success")
               {
                console.log(data.data.logs)
                  this.users = data.data.logs;
               }else{

               }
      })
      .catch(() =>{

      });

      // this.$inertia.get("",{onSuccess:(data) =>
      // {

      //     console.log(data);
      // }})
    },
    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },
}
</script>
