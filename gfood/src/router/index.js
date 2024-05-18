import Vue from "vue";
import VueRouter from "vue-router";
import HomeFood from "@/views/Home";
import Connexion from "@/views/Connexion";
import Menu from "@/views/Menu";
import Rejoindre from "@/views/Rejoindre";
import Accueil from "@/components/Accueil";
import AccueilSalarie from "@/components/AccueilSalarie";
Vue.use(VueRouter);

function guardMyroute (to, from, next) {
  var isAuthenticated = false
  isAuthenticated = !!sessionStorage.getItem('users');
  if (isAuthenticated) {
    next() // allow to enter route
  } else {
    next('/connexion') // go to '/login';
  }
}

const routes = [
  {
    path: '/',
    component: () => import('@/components/Accueil.vue'),
    children: [
      { path: '/'
        , name:'home'
        , component: () => import('@/views/Home.vue')
      },
      {
        path: '/menu',
        name: 'menu',
        component: Menu
      },
      {
        path: '/rejoindre',
        name: 'rejoindre',
        component: Rejoindre
      }
    ]
  },

  {
    path: '/wfood',
    component: () => import('@/components/AccueilSalarie.vue'),
    beforeEnter: guardMyroute,
    children: [
      { path: '/'
        , name:'acceuil'
        , component: () => import('@/views/Menu.vue')
      },
      { path: '/wfood/menu'
        , name:'salarie-menu'
        , component: () => import('@/views/Menu.vue')
      },
      { path: '/wfood/panier'
        , name:'salarie-panier'
        , component: () => import('@/views/Panier.vue')
      },
      { path: '/wfood/commande'
        , name:'salarie-commande'
        , component: () => import('@/views/Commande.vue')
      },
    ]
  },

  {
    path: '/connexion',
    name: 'connexion',
    component: Connexion
  },

];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
