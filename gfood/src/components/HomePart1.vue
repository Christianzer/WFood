<template>
  <v-container fluid fill-height class="home-hero" style="max-height: 100vh;">
    <v-layout justify-center align-center column pa-5>
      <div class="display-4 font-weight-black white--text text-xs-center">REPAS SAINS</div>
      <div class="display-4 font-weight-black white--text text-xs-center mb-3">POUR VOTRE TABLE</div>
      <div class="display-1 font-weight-bold white--text text-xs-center">Soyez enfin un fin gourmet à la maison avec des repas frais préparés par un chef,
        livrés quotidiennement à votre porte.</div>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  name: "HomePart1"
};
</script>

<style scoped>
.home-hero {
  background: url('http://source.unsplash.com/0BhSKStVtdM');
  background-size: cover;
  width: 100%;
  height: 100%;
}
</style>