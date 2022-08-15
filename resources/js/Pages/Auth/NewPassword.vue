<template>
  <Head title="New Password" />
  <div class="flex items-center justify-center p-6 min-h-screen bg-indigo-800">
    <div class="w-full max-w-md">
      <logo class="block mx-auto w-full max-w-xs fill-white" height="50" />
       <br>
        <flash-messages />
      <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="login">
        <div class="px-10 py-12">
          <h1 class="text-center text-3xl font-bold">Set New password</h1>
          <div class="mt-6 mx-auto w-24 border-b-2" />
          <text-input v-model="form.email" :error="form.errors.email"  disabled class="mt-10" label="Email" type="email" autofocus autocapitalize="off" />
          <br/>
          <text-input v-model="form.password" :error="form.errors.password" class="mt-6" label="Password" type="password" />
            <text-input v-model="form.password_confirmation" :error="form.errors.password_confirmation" class="mt-6" label="Confirm Password" type="password" />
        </div>
        <div class="flex px-10 py-4 bg-gray-100 border-t border-gray-100">
           <Link href="login" style="float:right;"><u> Login</u></Link>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Save</loading-button>
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
        email: new URL(location.href).searchParams.get('email'),
        token:new URL(location.href).searchParams.get('token'),
        password: '',
        password_confirmation:''
      }),
    }
  },
  methods: {
    login() {
      this.form.post('/set-password')
    },
  },
}
</script>
