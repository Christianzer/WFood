<template>
  <v-container grid-list-lg>



    <v-col cols="12" sm="12">
      <v-card class="mx-auto" tile>
        <v-card-title class="text-uppercase">Recherche</v-card-title>

        <v-card-text>
          <v-form
            ref="form"
            v-model="valid"
            lazy-validation
          >
            <v-row>
              <v-col
                cols="12"
                md="5"
              >
                <v-text-field
                  v-model="dateDebut"
                  type="date"
                  label="DATE DEBUT"
                  :rules="[() => !!dateDebut || 'DATE DEBUT REQUIS']"
                  required
                ></v-text-field>
              </v-col>

              <v-col
                cols="12"
                md="5"
              >
                <v-text-field
                  type="date"
                  v-model="dateFin"
                  label="DATE FIN"
                  :rules="[() => !!dateFin || 'DATE FIN REQUIS']"
                  required
                ></v-text-field>
              </v-col>

              <v-col
                cols="12"
                md="2"
                class="mt-4"
              >
                <v-btn
                  :disabled="!valid"
                  color="success"
                  class="mr-4"
                  @click="validate"
                >
                  Rechercher
                </v-btn>
              </v-col>


            </v-row>
          </v-form>
        </v-card-text>
      </v-card>

      <br>

      <v-progress-circular
        indeterminate
        :size="70"
        :width="7" cols="12" sm="12"
        color="red" v-if="loading === false"
      ></v-progress-circular>

      <v-card class="mx-auto" tile v-else>
        <v-card-title class="text-uppercase">Listes des commandes</v-card-title>

        <v-simple-table class="text-lg-h6">

          <thead>
          <tr class="text-uppercase text-left">
            <th class="text-left" v-if="users.type === 2">Salarie</th>
            <th>Plat</th>
            <th>Prix</th>
            <th>Accompagnements</th>
            <th class="text-center">Total</th>
            <th class="text-center">Date commande</th>

          </tr>
          </thead>
          <tbody>
          <tr v-for="item in items" :key="item.id_plat">
            <td v-if="users.type === 2">
              {{ item.name }}
            </td>
            <td>
              {{ item.nom_plat }}
            </td>
            <td>{{ formatPrice(parseFloat(item.prix_plat)) }}</td>
            <td>
              <ul>
                <li v-for="accompagnement in JSON.parse(item.accompagnement)" :key="accompagnement.id_accompagnements">
                  {{ accompagnement.nom_accompagnement }} - {{  formatPrice(parseFloat(accompagnement.prix_accompagnement)) }}
                </li>
              </ul>
            </td>
            <td class="text-right">
              {{ formatPrice(item.total_commande) }}
            </td>
            <td class="text-right">
              {{ formatDate(item.dateCommande) }}
            </td>
          </tr>
          </tbody>

        </v-simple-table>
      </v-card>
    </v-col>


  </v-container>
</template>

<script>


export default {
  name: "Commande",
  data() {
    return {
      dateDebut : '',
      users : '',
      dateFin:'',
      loading : false,
      valid: false,
      items: [],
      dateDebutRulle: [
        v => !!v || 'Name is required',
        v => (v && v.length <= 10) || 'Name must be less than 10 characters',
      ],
    };
  },
  created () {
    this.users = JSON.parse(sessionStorage.getItem('users'))
    this.initialize(this.users.id_users,null,null)
  },

  methods: {
    async initialize (user,dateDebut,dateFin) {
      var userId = null
      if (this.users.type === 1){
        userId = user
      }
      this.loading = false
      await this.$http.get("/listes-des-commandes/"+userId+"/"+dateDebut+"/"+dateFin).then(response => response.data)
        .then(data => {
          this.items = data
        });

      this.loading = true
    },

    async validate () {
      if (this.$refs.form.validate()){
        await this.initialize(this.users.id_users,this.dateDebut,this.dateFin);
      }

    },

    formatPrice(prix) {
      return new Intl.NumberFormat('fr-CI', { style: 'currency', currency: 'XOF' }).format(prix);
    },

    formatDate(date) {
      const options = {
        day: 'numeric',
        month: 'short',
        year: 'numeric',
      };
      return  new Intl.DateTimeFormat('fr-FR', options).format(new Date(date));
    }
  },


};
</script>

<style scoped>
.v-data-table th {
  font-weight: bold;
}
</style>