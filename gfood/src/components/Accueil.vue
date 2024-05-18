<template>
  <span id="inspire">
    <v-overlay :value="drawer" z-index="4">
    </v-overlay>
    <v-navigation-drawer v-model="drawer" app clipped hide-overlay :style="{ top: $vuetify.application.top + 'px', zIndex: 6 }">
      <v-list dense>
        <template class="text-uppercase" v-for="(item, index) in items">
          <v-list-item :to="item.url">
            {{item.title}}
          </v-list-item>
        </template>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar app clipped-left dark color="#447fa6">
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <router-link to="/">
        <v-app-bar-title class="title"><div style="color: white">W-FOOD</div></v-app-bar-title>
      </router-link>
       <v-btn
         flat
         class="hidden-sm-and-down nav-menu ma-1"
         to="/menu"
         data-cy="menuBtn"
       >Menu</v-btn
       >
      <v-spacer class="hidden-sm-and-down"></v-spacer>
      <v-btn flat class="hidden-sm-and-down" to="/connexion">SE CONNECTER</v-btn>
      <v-btn color="brown lighten-3" class="hidden-sm-and-down ma-5" to="/rejoindre">INSCRIRE</v-btn>
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
        { title: 'MENU', url: '/' },
        { title: 'SE CONNECTER', url: '/connexion' },
        { title: 'INSCRIRE', url: '/INSCRIRE' }
      ]
    };
  },
  methods: {
  },
  mounted() {

  }
};
</script>

<style scoped>
a {
  color: white;
  text-decoration: none;
}
</style>