<template>
  <v-layout align-center justify-center>
    <v-flex xs12 sm10 m8>
      <v-toolbar flat color="white">
        <v-toolbar-title>Time Entries</v-toolbar-title>
        <v-divider class="mx-2" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <v-btn slot="activator" color="primary" dark class="mb-2">New Item</v-btn>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.firstName" label="Fitst Name"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.lastName" label="Last Name"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.calories" label="Calories"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.fat" label="Fat (g)"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.carbs" label="Carbs (g)"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
              <v-btn color="blue darken-1" flat @click="save">Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
      <v-data-table :headers="headers" :items="timeEntries" class="elevation-0">
        <template slot="items" slot-scope="props">
          <td class="d-none">{{ props.item.id }}</td>
          <td>{{ props.item.name }}</td>
          <td class="text-xs-left">{{ props.item.date }}</td>
          <td class="text-xs-left">{{ props.item.hours }}</td>
          <td class="text-xs-left">{{ props.item.amount }}</td>
          <td class="text-xs-left">{{ props.item.job }}</td>
          <td class="justify-center layout px-0">
            <v-icon small class="mr-2" @click="editItem(props.item)">edit</v-icon>
            <v-icon small @click="deleteItem(props.item)">delete</v-icon>
          </td>
        </template>
        <!-- <template slot="no-data">
          <v-btn color="primary" @click="initialize">Reset</v-btn>
        </template> -->
      </v-data-table>
    </v-flex>
  </v-layout>
</template>
<script>
export default {
  data: () => ({
    dialog: false,
    headers: [
        { text: "Name", align: "left", sortable: false, value: "name" },
        { text: "Date", align: "left", value: "date" },
        { text: "Hours", align: "left", value: "hours" },
        { text: "Amount", value: "left" },
        { text: "Job", align: "left", value: "job" },
    ],
    editedIndex: -1,
    editedItem: {
      name: "",
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0
    },
    defaultItem: {
      name: "",
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0
    }
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },

    timeEntries() {
      return this.$store.state.timeEntries;
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  created() {
    this.$store.dispatch("FETCH_TIME_ENTRIES");
  },

  methods: {

    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.timeEntries.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        this.$store.dispatch("deleteTimeEntry", item.id);
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem);
      } else {
        this.desserts.push(this.editedItem);
      }
      this.close();
    }
  }
};
</script>
<style scoped>
</style>
