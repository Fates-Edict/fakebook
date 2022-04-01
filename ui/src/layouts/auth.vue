<template>
  <q-layout view="hHh Lpr fFf" class="bg-secondary"> 

    <div class="text-center">
      <img width="250" src="https://static.xx.fbcdn.net/rsrc.php/y8/r/dF5SId3UHWd.svg" />
    </div>
    <q-page-container>
      <router-view />
    </q-page-container>

  </q-layout>
</template>

<script>
export default {
  name: 'AuthLayout',
}
</script>
