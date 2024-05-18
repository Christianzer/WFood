<template>
  <span id="inspire">
    <v-overlay :value="drawer" z-index="4">
    </v-overlay>
    <v-navigation-drawer v-model="drawer" app clipped hide-overlay :style="{ top: $vuetify.application.top + 'px', zIndex: 6 }">
      <v-list dense>
         <v-list-item @click="logout" to="/wfood/menu" v-if="users.type === 1">
            MENU
          </v-list-item>
        <template class="text-uppercase" v-for="(item, index) in items">
          <v-list-item :to="item.url">
            {{item.title}}
          </v-list-item>
        </template>
         <v-list-item @click="logout">
            DECONNEXION
          </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app clipped-left dark color="#447fa6">
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <v-app-bar-title class="title"><div style="color: white">W-FOOD</div></v-app-bar-title>
       <v-btn v-if="users.type === 1"
         flat
         class="hidden-sm-and-down nav-menu ma-1"
         to="/wfood/menu"
         data-cy="menuBtn"
       >Menu</v-btn
       >

      <v-spacer class="hidden-sm-and-down"></v-spacer>
      <v-app-bar-title class="title mr-5 text-uppercase"><div style="color: white">{{this.users.name}}
        <span class="font-weight-bold" v-if="users.type === 1">(SALARIE)</span>
        <span class="font-weight-bold" v-else>(ADMINISTRATEUR)</span>

      </div></v-app-bar-title>
       <v-btn flat class="hidden-sm-and-down" to="/wfood/commande">COMMANDES</v-btn>
      <v-btn color="error" class="hidden-sm-and-down ma-5" @click="logout">DECONNEXION</v-btn>
    </v-app-bar>

    <router-view></router-view>
  </span>
</template>

<script>


export default {
  name: 'AppNavigation',
  data() {
    return {
      drawer: false,
      users: null,
      items: [
        { title: 'COMMANDES', url: '/wfood/commande' },
      ]
    };
  },
  methods: {
    logout(){
      sessionStorage.clear();
      this.$router.push({name : 'home'})
    }
  },
  created () {
    this.users = JSON.parse(sessionStorage.getItem('users'))
  },
};
</script>

<style scoped>
a {
  color: white;
  text-decoration: none;
}
</style>