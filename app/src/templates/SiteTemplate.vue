<template>
  <v-app>
      <header>
        <ToolBarVue logo="Projeto" fixed>
          <v-btn v-if="user && token" flat>Home</v-btn>
          <v-btn v-if="!user && !token" flat to="/login">Login</v-btn>
          <v-btn v-if="!user && !token" fla to="/register">Register</v-btn>

          <v-btn v-if="user && token" flat color="blue-grey lighten-5" v-bind:to="'/perfil/' + user.id">{{user.username}}</v-btn>
          <v-btn v-if="user && token" flat color="orange" to="/logout">Sair</v-btn>
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
  name: 'SiteTemplate',
  components: {
    ToolBarVue,
    FooterVue
  },
  data:() => ({
      user: '',
      token: false
  }),
  created(){
    let user = sessionStorage.getItem('user');
    if(this.getToken){
        this.user = JSON.parse(user);
    }else{
      return this.$router.push('/login');
    }
  },
  computed: {
    getToken(){
      let token = sessionStorage.getItem('token');
      if(token){
        this.token = JSON.parse(token);
        return true;
      }
      return false;
    }
  }
}
</script>