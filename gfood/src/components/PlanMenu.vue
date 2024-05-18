<template>
  <v-container grid-list-lg>
    <v-layout row>
      <v-flex xs12 class="text-xs-center display-1 font-weight-black my-5">Plans de repas disponibles</v-flex>
    </v-layout>
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

                <v-card-text>
                  <div class="font-weight-bold ml-8 mb-2">
                    Accompagenement
                  </div>

                  <v-timeline
                    align-top
                    dense
                  >
                    <v-timeline-item
                      v-for="(item, index) in plat.accompagnements"
                      :key="index"
                      color="red"
                      small
                    >
                      <div>
                        <div class="font-weight-normal">
                          <strong> {{item.nom_accompagnement }} </strong> {{ item.prix }} FCFA
                        </div>
                      </div>
                    </v-timeline-item>
                  </v-timeline>
                </v-card-text>

              </v-col>
            </v-row>
          </v-container>
        </v-tab-item>
      </v-tabs-items>
    </v-card>
    <v-layout row wrap>

    </v-layout>
  </v-container>
</template>

<script>
import axios from 'axios'
export default {
  name: "PlanMenu",
  data() {
    return {
      drawer: false,
      loading : false,
      tab: 'lundi',
      items: []
    };
  },
  created () {
    this.initialize()
  },

  methods: {
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

<style scoped>

</style>