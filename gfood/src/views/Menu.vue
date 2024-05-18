<template>
  <v-container grid-list-lg>
    <v-progress-circular
      indeterminate
      :size="70"
      :width="7"
      color="red" v-if="loading === false"
    ></v-progress-circular>
    <v-card v-else>
      <v-tabs
        v-model="tab"
        fixed-tabs
        class="font-weight-bold"
        color="deep-purple accent-4"
      >
        <v-tab
          v-for="(jour, index) in items"
          :key="index"
        >
          {{ index }}
        </v-tab>

      </v-tabs>
      <v-tabs-items v-model="tab">
        <v-tab-item
          v-for="(jour, index) in items"
          :key="index"
        >
          <v-container fluid>
            <v-row>
              <v-col
                v-for="(plat, indexPlat) in jour"
                :key="indexPlat"
                cols="12"
                md="4"
              >
                <v-card>
                  <v-responsive>

                    <v-img
                      :src="plat.image"
                      :lazy-src="plat.image"
                      aspect-ratio="1"
                    ></v-img>
                  </v-responsive>
                  <v-card-title>
                    {{plat.nom_plat}}
                  </v-card-title>
                </v-card>

                <v-divider class="mx-4"></v-divider>

                <v-card-title>Accompagenement</v-card-title>

                <v-card-text>
                  <v-chip-group
                    v-model="selection"
                    active-class="deep-purple accent-4 white--text"
                    column
                    multiple
                  >
                    <v-chip
                      v-for="(item, indexApp) in plat.accompagnements"
                      :key="indexApp"
                      :value="item.id_accompagnements+';'+plat.id_plat+';'+index"
                    >
                      {{ item.nom_accompagnement }}
                    </v-chip>
                  </v-chip-group>
                </v-card-text>
              </v-col>

              <v-card-text style="height: 100px; position: relative">
                <v-fab-transition>
                  <v-btn
                    @click="reserve"
                    color="pink"
                    dark
                    absolute
                    top
                    right

                  >
                    Commander
                  </v-btn>
                </v-fab-transition>
              </v-card-text>
            </v-row>
          </v-container>
        </v-tab-item>
      </v-tabs-items>
    </v-card>
    <v-layout row wrap>

    </v-layout>

    <v-snackbar
      v-model="commandOf"
      :timeout="timeout"
      absolute
      class="font-weight-bold"
      color="red accent-2"
    >

      {{error}}

      <template v-slot:action="{ attrs }">
        <v-btn
          color="white"
          text
          v-bind="attrs"
          @click="commandOf = false"
        >
          Fermer
        </v-btn>
      </template>
    </v-snackbar>
  </v-container>
</template>

<script>

export default {
  name: "PlanMenu",
  data() {
    return {
      drawer: false,
      error :'',
      timeout: 2000,
      commandOf : false,
      loading : false,
      selection: '',
      tab: 'lundi',
      items: []
    };
  },
  created () {
    this.initialize()
  },

  methods: {
    reserve(){



      var isAuthenticated = false
      isAuthenticated = sessionStorage.getItem('users');

      if (this.selection.length === 0){
        this.error = "Veuillez selectionner au moins un accomapgnement"
        this.commandOf = true
      }

      else if (!isAuthenticated) {
        this.error = "Veuillez vous connecter pour pouvoir passer une commande sinon veuillez vous inscrire svp !!!"
        this.commandOf = true
      }


      else {



        const now = new Date();

        const referenceHeures = 11;
        const referenceMinutes = 0;
        const referenceSecondes = 0;

        const isAfter = now > new Date(now.getFullYear(), now.getMonth(), now.getDate(), referenceHeures, referenceMinutes, referenceSecondes);

        if (isAfter) {
          this.error = "Vous ne pouvez plus passer de commande apres 11H !!!"
          this.commandOf = true
        }else{
          sessionStorage.setItem('produits',this.selection)
          this.$router.push({
            name: 'salarie-panier' })
        }

      }
    },
    initialize () {

      this.loading = false
      this.$http.get('/listes-des-plats')
        .then(response => {
          this.items = response.data;
        });
      this.loading = true
    },
  },
};
</script>
