<template>
  <v-app>
    <v-navigation-drawer v-model="drawer" fixed app>
      <v-list dense>
        <v-list-tile  :to="{ name: 'home' }">
          <v-list-tile-action >
            <v-icon>home</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Home</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile  :to="{ name: 'wibble' }">
          <v-list-tile-action>
            <v-icon>contact_mail</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Wibble</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        </v-list-tile>
        <v-list-tile  :to="{ name: 'page' }">
          <v-list-tile-action>
            <v-icon>contact_mail</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Page</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar dark flat color="primary">
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <v-toolbar-title>JKL</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items class="hidden-sm-and-down">
        <v-btn flat :to="{ name: 'home' }">Home</v-btn>
        <v-btn flat :to="{ name: 'wibble' }">Wibble</v-btn>
        <v-btn flat :to="{ name: 'page' }">Page</v-btn>
      </v-toolbar-items>
    </v-toolbar>
    <v-content>
      <v-container fluid>
        <v-fade-transition mode="out-in">
          <router-view></router-view>
        </v-fade-transition>
      </v-container>
    </v-content>

    <!-- <b-nav-item :to="{ name: 'home' }">Home</b-nav-item>
            <b-nav-item :to="{ name: 'wibble' }">Wibble</b-nav-item>
    <b-nav-item :to="{ name: 'page' }">Page</b-nav-item>-->
  </v-app>
</template>
<script>
export default {
  data: () => ({
    drawer: null
  }),
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
