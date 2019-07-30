<template>
  <v-layout align-center justify-center>
    <v-flex xs12 sm10 m8>
      <v-toolbar flat color="white">
        <v-toolbar-title>Time Entries</v-toolbar-title>
        <v-spacer></v-spacer>
      </v-toolbar>
      <v-data-table
        :headers="headers"
        hide-actions
        pagination.sync
        :loading="loading"
        :items="getTimeEntries"
        disable-initial-sort
        class="elevation-0"
      >
        <template slot="items" slot-scope="props">
          <td class="d-none">{{ props.item.id }}</td>
          <td>{{ props.item.worker.forename }} {{ props.item.worker.last_name }}</td>
          <td class="text-xs-left">{{ props.item.date }}</td>
          <td class="text-xs-left">{{ props.item.hours }}</td>
          <td class="text-xs-left">{{ props.item.amount / 100 }}</td>
          <td class="text-xs-left">{{ props.item.job.name }} {{ props.item.job.description }}</td>
          <td class="justify-center layout px-0">
            <v-icon small @click="deleteTimeEntry(props.item)">delete</v-icon>
          </td>
        </template>
        <template slot="no-data">
          <v-alert :value="fetchErr.state" color="error" icon="warning">no data, status: {{fetchErr.status}} :(</v-alert>
        </template>
      </v-data-table>
      <v-pagination v-model="pagination.current" :length="pagination.total" @input="onPageChange"></v-pagination>
    </v-flex>
  </v-layout>
</template>
<script>
import Axios from "axios";
export default {
  data: () => ({
    timeEntries: [],
    fetchErr: {
      state: false,
      message: '',
      status: ''
    },
    pagination: {
      current: 1,
      total: 0
    },
    loading: false,
    headers: [
      { text: "Name", align: "left", sortable: false, value: "name" },
      { text: "Date", align: "left", value: "date" },
      { text: "Hours", align: "left", value: "hours" },
      { text: "Amount", value: "left" },
      { text: "Job", align: "left", value: "job" }
    ]
  }),

  computed: {
    getTimeEntries() {
      //return this.$store.state.timeEntries;
      return this.timeEntries;
    }
  },

  watch: {},

  created() {
    //this.$store.dispatch("FETCH_TIME_ENTRIES");
    this.fetchTimeEntries();
  },

  methods: {
    async fetchTimeEntries() {
      this.dataFetchErr = false;
      this.loading = true;
      // get data and status properties from axios response
      try {
        let { data, status } = await Axios.get(
          "api/time-entries?page=" + this.pagination.current
        );
        // get nested data obj renamed to timeEntries and stick the rest in pageObj
        let { data: timeData, ...pageObj } = data;
        this.timeEntries = timeData;
        this.loading = false;
        this.pagination.current = pageObj.current_page;
        this.pagination.total = pageObj.last_page;
      } catch(err) {;
        { err.result };
        this.fetchErr.state = true;
        this.fetchErr.status = err.response.status;
      }
    },
    async deleteTimeEntry(item) {
      if (confirm("Are you sure you want to delete this item?")) {
        const response = await Axios.delete("api/time-entry/" + item.id);
        //remove from this.timeEntries:
        const index = this.timeEntries.indexOf(item);
        this.timeEntries.splice(index, 1);
      }
    },

    onPageChange() {
      this.fetchTimeEntries();
    }
  }
};
</script>
<style scoped>
</style>
