<template>
  <router-view :key="$route.path"></router-view>
</template>

<script>
import axios from 'axios'
import router from '@/js/router'
import store from '@/js/stores'

export default {
  mounted() {
    axios.interceptors.response.use(function (response) {
      return response;
    }, function (error) {
      if (error.response.status === 401 || error.response.status === 419) {
        if(error.response.data.message === 'CSRF token mismatch.') return
        store.dispatch('logout')
        router.replace({name: 'Login'})
      } else if(error.response.status === 403) {
        router.push({name: 'VerifyEmail'})
      } else if(error.response.status === 423) {
        router.push({name: 'ConfirmPassword'})
      }

      return Promise.reject(error);
    });
  },
}
</script>
<style scoped>
@import url('https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic');
*{
    font-family: 'Roboto', sans-serif;
}
</style>
