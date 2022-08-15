<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap -mb-1">
      <template v-for="(link, key) in links">
        <div v-if="link.url === null" :key="key" class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded" v-html="link.label" />
        <a v-else :key="`link-${key}`" class="mb-1 mr-1 px-4 py-3 focus:text-indigo-500 text-sm leading-4 hover:bg-white border focus:border-indigo-500 rounded" :class="{ 'bg-white': link.active }" href="javascript:void(0)"  @click="goTo(link)" v-html="link.label" ></a>
      </template>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
  components: {
    Link,
  },
  props: {
    links: Array,
  },
  methods:{
      goTo()
      {
          let url_ =  arguments[0].url.split('?');
          let page_ =  url_[url_.length-1].split("=");
          let pageNumber = page_[page_.length -1];
          window.open(window.origin+"/users_activity?page="+pageNumber,"_top");
      }
  }
}
</script>
