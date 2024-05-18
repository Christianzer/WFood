<template>
  <v-container fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md4>
        <v-card class="elevation-12">
          <v-toolbar dark color="primary">
            <v-toolbar-title>CONNEXION</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form ref="form" v-model="valid">
              <v-text-field
                name="email"
                label="Email"
                type="email"
                v-model="email"
                :rules="emailRules"
                required
                data-cy="signinEmailField"
              >
              </v-text-field>
              <v-text-field
                name="password"
                label="Mot de passe"
                type="password"
                data-cy="signinPasswordField"
                v-model="password"
                :rules="passwordRules"
                required
              >
              </v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="error"
              @click="retour"

            >Retour</v-btn
            >
            <v-btn
              color="primary"
              :disabled="!valid"
              @click="submit"
              data-cy="signinSubmitBtn"
            >Se connecter</v-btn
            >
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import axios from 'axios'
export default {
  name: 'Signin',
  data() {
    return {
      valid: false,
      email: '',
      password: '',
      emailRules: [
        v => !!v || 'Un e-mail est requis',
        v => /.+@.+/.test(v) || 'L\'email doit être valide'
      ],
      passwordRules: [
        v => !!v || 'Mot de passe requis',
        v =>
          v.length >= 3 ||
          'Le mot de passe doit comporter plus de 3 caractères'
      ]
    };
  },
  methods: {
    async submit() {
      const  dataInsert = {
        'email' :this.email,
        'password':this.password
      }
      await this.$http.post("/connexion",dataInsert)
        .then(response => {
          if (response.status === 201){
            sessionStorage.setItem('users', JSON.stringify(response.data));
            console.log(response.data.type)

            if (parseFloat(response.data.type) === 1){
              this.$router.push({ name: 'acceuil' })
            }else {
              this.$router.push({ name: 'salarie-commande' })
            }



          }
          if (response.data === 406){
            console.log('erruer')
          }

        })
    },
    retour() {
      this.$router.push({ name: 'home' })
    }
  }
};
</script>

<style scoped></style>