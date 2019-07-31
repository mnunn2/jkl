<template>
  <v-layout align-center justify-center>
    <v-flex xs12 sm10 m8>
      <v-data-table
        :headers="headers"
        :loading="loading"
        :items="timeEntries"
        hide-default-footer
        pagination.sync
        class="elevation-0"
      >
        <template v-slot:top>
          <v-toolbar flat color="white">
            <v-toolbar-title>{{ title }}</v-toolbar-title>
            <v-spacer></v-spacer>
          </v-toolbar>
        </template>
        <template v-slot:item.action="{ item }">
          <v-icon small @click="deleteTimeEntry(item)">delete</v-icon>
        </template>
        <!-- <template slot="items" slot-scope="props">
          <td class="d-none">{{ props.item.id }}</td>
          <td>{{ props.item.worker.forename }} {{ props.item.worker.last_name }}</td>
          <td class="text-xs-left">{{ props.item.date }}</td>
          <td class="text-xs-left">{{ props.item.hours }}</td>
          <td class="text-xs-left">{{ props.item.amount / 100 }}</td>
          <td class="text-xs-left">{{ props.item.job.name }} {{ props.item.job.description }}</td>
          <td class="justify-center layout px-0">
            <v-icon small @click="deleteTimeEntry(props.item)">delete</v-icon>
          </td>
        </template> -->
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
  // props from router in main.js
  props: ['title'],
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
      { text: "Amount", align: "left", value: "amount"},
      { text: "Job", align: "left", value: "job" },
      { text: "Actions", value: "action" },
    ]
  }),

  computed: {},

  watch: {},

  created() {
    this.fetchTimeEntries();
  },

  methods: {
    updateTimeEntries(timeData) {
      // manipulate api return to suit table
      this.timeEntries = timeData.map((item) => {
        return {
          id: item.id,
          name: item.worker.forename + " " + item.worker.last_name,
          date: item.date,
          hours: item.hours,
          amount: item.amount / 100,
          job: item.job.name + " " + item.job.description
        }
      });
    },
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
        this.updateTimeEntries(timeData);
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
      console.log(item);
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
