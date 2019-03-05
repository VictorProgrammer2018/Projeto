import Vue from "vue";
import Router from "vue-router";
import Home from "./views/Home.vue";

Vue.use(Router);

export default new Router({
  mode: "history",
  base: process.env.BASE_URL,
  routes: [
    {
      path: "/",
      name: "home",
      component: Home
    },
    {
      path: "/about",
      name: "about",
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () =>
        import(/* webpackChunkName: "about" */ "./views/About.vue")
    },

    //component logout
    {
      path: '/logout',
      name: 'logout',
      component: () => import("./views/Logout.vue")
    },

    //login
    {
      path: '/login',
      name: 'login',
      component: () => import("./views/Login.vue")
    },

    //register
    {
      path: '/register',
      name: 'register',
      component: () => import('./views/Register.vue')
    },

    //upate perfil client
    {
      path: '/perfil/:id',
      name: 'perfil',
      component: () => import('./views/Perfil.vue')
    }
  ]
});
