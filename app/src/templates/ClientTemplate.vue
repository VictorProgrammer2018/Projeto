<template>
  <v-app>
      <header>
        <ToolBarVue logo="Projeto" fixed>
          <v-btn  flat to="/login">Login</v-btn>
          <v-btn  fla to="/register">Register</v-btn>
        </ToolBarVue>
      </header>

     <main>
        <v-content>
          <slot></slot>
        </v-content>
     </main>

     <footer-vue></footer-vue>
  </v-app>
</template>

<script>
import ToolBarVue from '../components/ToolBarVue'
import FooterVue from '../components/FooterVue'
export default {
  name: 'ClientTemplate',
  components: {
    ToolBarVue,
    FooterVue
  }
}
</script>