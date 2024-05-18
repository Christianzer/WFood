<template>
  <v-container grid-list-lg>

    <v-progress-circular
      indeterminate
      :size="70"
      :width="7" cols="12" sm="12"
      color="red" v-if="loading === false"
    ></v-progress-circular>

    <v-col cols="12" sm="12" v-else>
      <v-card class="mx-auto" tile>
        <v-card-title>Panier</v-card-title>

        <v-simple-table class="text-lg-h6">

            <thead>
            <tr class="text-uppercase text-left">
              <th>Plat</th>
              <th>Prix</th>
              <th>Accompagnements</th>
              <th class="text-center">Total</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in items" :key="item.id_plats">
              <td>
                <v-avatar v-if="item.plats.image">
                  <v-img :src="item.plats.image"></v-img>
                </v-avatar>
                <span>{{ item.plats.nom_plat }}</span>
              </td>
              <td>{{ formatPrice(parseFloat(item.plats.prix)) }}</td>
              <td>
                <ul>
                  <li v-for="accompagnement in item.accompagnement" :key="accompagnement.id_accompagnements">
                    {{ accompagnement.nom_accompagnement }} - {{  formatPrice(parseFloat(accompagnement.prix)) }}
                  </li>
                </ul>
              </td>
              <td>{{ formatPrice(calculerTotal(item)) }}</td>
            </tr>
            </tbody>

        </v-simple-table>

        <v-card-text class="text-right">
          <span class="font-weight-bold text-uppercase red--text" > total : </span>
          <span class="font-weight-bold text-uppercase red--text"> {{ formatPrice(totalColonneTotal) }} </span>
        </v-card-text>

        <v-btn class="mt-4 mr-4 ml-4 mb-4" color="error" @click="validerCommandes">Valider panier</v-btn>

      </v-card>
    </v-col>


  </v-container>
</template>

<script>


export default {
  name: "Panier",
  data() {
    return {
      drawer: false,
      loading : false,
      tab: 'lundi',
      items: [],
      totalGeneral: 0,
      dialogSupprimerAccompagnement: false,
      accompagnementASupprimer: null,
    };
  },
  created () {
    this.initialize()
  },

  methods: {
    async initialize () {
      this.loading = false
      const produits = sessionStorage.getItem('produits')
      const rows = produits.split(',');
      const produitsArray = [];
      for (const row of rows) {
        const values = row.split(';');
        const dataObject = {
          accompagnement: parseInt(values[0]),
          plat: parseInt(values[1]),
          jour: values[2],
        };
        produitsArray.push(dataObject);
      }

      await this.$http.post("/panier",produitsArray)
        .then(response => {
          this.items = response.data
        })
      this.loading = true
    },

    formatPrice(prix) {
      return new Intl.NumberFormat('fr-CI', { style: 'currency', currency: 'XOF' }).format(prix);
    },

    calculerTotal(plat) {
      let total = parseFloat(plat.plats.prix);
      plat.accompagnement.forEach(accompagnement => {
        total += parseFloat(accompagnement.prix);
      });
      return total;
    },

    async validerCommandes() {

      const commandes = this.items.map(plat => {

        return {
          id_plat: plat.plats.id_plats,
          nom_plat: plat.plats.nom_plat,
          prix_plat: plat.plats.prix,
          accompagnement: plat.accompagnement.map(accompagnement => {
            return {
              id_accompagnement: accompagnement.id_accompagnements,
              nom_accompagnement: accompagnement.nom_accompagnement,
              prix_accompagnement: accompagnement.prix,
            }
          }),
          total_commande: this.calculerTotal(plat),
        }
      })

      await this.$http.post("/commandes",commandes)
        .then(response => {
          this.$router.push({name : 'salarie-commande'})
        })


      this.commandes = []
    },

  },
  computed: {

    totalColonneTotal() {
      return this.items.reduce((total, plat) => {
        return total + this.calculerTotal(plat);
      }, 0);
    },


  },

};
</script>

<style scoped>
.v-data-table th {
  font-weight: bold;
}
</style>