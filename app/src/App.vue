<template>
  <v-app>
       <router-view />
  </v-app>
</template>

<script>

export default {
  name: 'App',
  data () {
    return {
      //
    }
  }
}
</script>

<style>
div.theme--light.application {
    background: #cfd8dc;
    color: rgba(0,0,0,0.87);
    height: 1000px;
}

</style>
