<template>
  <site-template>
      <HelloWorld class="px-0">
        <v-layout row>
          <v-flex xs6>
            <card-vue></card-vue>
        </v-flex>
        </v-layout>
          <v-layout row>
          <v-flex xs6>
            <card-vue></card-vue>
        </v-flex>
        </v-layout>
  </HelloWorld>
  </site-template>
</template>

<script>
  import HelloWorld from '../components/HelloWorld'
  import SiteTemplate from '../templates/SiteTemplate'
  import CardVue from '../components/CardVue'
  export default {
    name: 'Home',
    components: {
      HelloWorld,
      SiteTemplate,
      CardVue
    }
  }
</script>
