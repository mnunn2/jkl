<template>
  <v-app>

    <v-navigation-drawer v-model="drawer" app>

      <v-list dense nav >
        <v-list-item
          exact

          v-for="item in topItems"
          :key="item.title"
          :to="item.name"
          link
        >
          <v-list-item-icon>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-group
            no-action
            prepend-icon="account_circle"
          >
            <template v-slot:activator>
              <v-list-item-content>
                <v-list-item-title>Admin</v-list-item-title>
              </v-list-item-content>
            </template>
  
            <v-list-item
              exact
              v-for="(admin, i) in adminItems"
              :key="i"
              :to="admin.name"
              link
            >
              <v-list-item-title v-text="admin.title"></v-list-item-title>
              <v-list-item-icon>
                <v-icon v-text="admin.icon"></v-icon>
              </v-list-item-icon>
            </v-list-item>
        </v-list-group>
      </v-list>

    </v-navigation-drawer>

    <v-app-bar dark flat color="primary" app>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>f
      <v-toolbar-title>JKL</v-toolbar-title>
    </v-app-bar>

    <v-content>
      <v-container fluid>
        <v-fade-transition mode="out-in">
          <router-view></router-view>
        </v-fade-transition>
      </v-container>
    </v-content>
  </v-app>
</template>
<script>
export default {
  data: () => ({
    topItems: [
      { name: {name: 'home'}, title: 'Home', icon: 'mdi-view-dashboard' },
      { name: {name: 'page'}, title: 'Page', icon: 'mdi-help-box' },
    ],
    adminItems: [
      { name: {name: 'timeEntry'}, title: 'Time Entries', icon: 'mdi-image' },
      { name: {name: 'home'}, title: 'Home', icon: 'mdi-view-dashboard' },
      { name: {name: 'page'}, title: 'Page', icon: 'mdi-help-box' },
    ],
    drawer: null,
  }),
  mounted() {
    //console.log(process.env.MIX_APP_BASE_URL);
  }
};
</script>
