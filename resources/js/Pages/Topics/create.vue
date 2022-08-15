<template>
  <div>
    <Head title="Create subjects topics" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/topics">subject topics</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">

          <select-input @change="selectedLevel($event)" v-model="form.level_id" :error="form.errors.level_id" class="pb-8 pr-6 w-full lg:w-1/2" label="levels">
            <option   v-for="lev in levels" :key="lev.id" :value="lev.id" >{{lev.name}}</option>
          </select-input>

           <div class="pb-8 pr-6 w-full lg:w-1/2">
           <label class="form-label">Subjects:</label>
          <!-- <select  v-model="form.subject_id"  class="form-select" :error="form.errors.subject_id">
               <option   v-for="sub in selectedLevels" :key="sub.id" :value="sub.id" >{{sub.name}}</option>
          </select> -->
          <!-- <div v-if="error" class="form-error"></div> -->
        </div>


          <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Name" />
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Create Topic</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
  },
  layout: Layout,
  remember: 'form',
  props: {
     levels: Object,
     subjects:Object
  },
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        level_id:null,
         subject_id:null
      }),
      selectedLevels:[]
    }
  },
  methods: {
    selectedLevel(e)
    {
        e.preventDefault();
        this.selectedLevels = [];
        this.subjects.forEach(el=>
        {
              if(el.level_id === e.target.value)
              {
                this.selectedLevels.push(el);
              }
          });
    },
    store() {
      this.form.post('/create_topic')
      }
    }
  }
</script>
