<template>
  <Head title="Login" />
  <div class="flex items-center justify-center p-6 min-h-screen bg-indigo-800">
    <div class="w-full max-w-md">
      <logo class="block mx-auto w-full max-w-xs fill-white" height="50" />
      <br>
        <flash-messages />
      <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="login">
        <div class="px-10 py-12">
          <h1 class="text-center text-3xl font-bold">We are sorry you, lost your password!</h1>
          <div class="mt-6 mx-auto w-24 border-b-2" />
          <text-input v-model="form.email" :error="form.errors.email" class="mt-10" label="Email" type="email" autofocus autocapitalize="off" />
        </div>
        <div class="flex px-10 py-4 bg-gray-100 border-t border-gray-100">
              <Link href="login">
              <u>
                Login
              </u>
              </Link>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Reset Token</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
import { Head,Link } from '@inertiajs/inertia-vue3'
import Logo from '@/Shared/Logo'
import TextInput from '@/Shared/TextInput'
import LoadingButton from '@/Shared/LoadingButton'
import FlashMessages from '@/Shared/FlashMessages'
export default {
  components: {
    Head,
    LoadingButton,
    Logo,
    TextInput,
    Link,
    FlashMessages
  },
  data() {
    return {
      form: this.$inertia.form({
        email: '',
      }),
    }
  },
  methods: {
    login() {
      this.form.post('/reset-email', {onSuccess: () => this.form.reset()})
    },
  },
}
</script>
