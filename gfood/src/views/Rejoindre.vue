<template>
  <v-container fill-height>
    <v-layout align-center justify-center>
      <v-flex xs12 sm8 md4>
        <v-card class="elevation-12">
          <v-toolbar dark color="primary">
            <v-toolbar-title>INSCRIRE</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form ref="form" v-model="valid" lazy-validation>
              <v-text-field
                name="name"
                label="Nom et Prenoms"
                type="text"
                v-model="nom"
                :rules="nomRule"
                data-cy="joinNomField"
                required
              >
              </v-text-field>
              <v-text-field
                name="email"
                label="Email"
                type="email"
                v-model="email"
                :rules="emailRules"
                data-cy="joinEmailField"
                required
              >
              </v-text-field>
              <v-text-field
                name="password"
                label="Mot de passe"
                type="password"
                required
                v-model="password"
                :rules="passwordRules"
                data-cy="joinPasswordField"
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
              data-cy="joinSubmitBtn"
            >INSCRIRE</v-btn
            >
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  name: 'Join',
  data() {
    return {
      valid: false,
      email: '',
      nom:'',
      password: '',
      emailRules: [
        v => !!v || 'Un e-mail est requis',
        v => /.+@.+/.test(v) || 'L\'email doit être valide'
      ],
      passwordRules: [
        v => !!v || 'Mot de passe requis',
        v =>
          v.length >= 6 ||
          'Le mot de passe doit comporter plus de 6 caractères'
      ],
      nomRule: [
        v => !!v || 'Nom requis',
        v =>
          v.length >= 6 ||
          'Le nom doit comporter plus de 6 caractères'
      ]
    };
  },
  methods: {
    retour() {
      this.$router.push({ name: 'home' })
    },
    submit() {

    }
  }
};
</script>

<style scoped></style>