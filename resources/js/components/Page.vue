
<template>
  <v-layout align-center justify-center>
    <v-flex xs10 sm7 m3>
      <v-data-table hide-actions :headers="headers" :items="timeEntries" class="elevation-0">
        <template slot="items" slot-scope="props">
          <td>{{ props.item.name }}</td>
          <td class="text-xs-right">{{ props.item.job }}</td>
          <td class="text-xs-right">{{ props.item.amount }}</td>
        </template>
      </v-data-table>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  data() {
    return {
      headers: [
        { text: "Name", align: "left", sortable: false, value: "name" },
        { text: "Job", align: "center", value: "job" },
        { text: "Amount", value: "amount" },
      ],
    };
  },
  computed: {
    timeEntries() {
      let timeEntries = this.$store.state.timeEntries.map(function(obj) {
        var rObj = {};
        rObj["name"] = obj.worker.forename + " " + obj.worker.last_name;
        rObj["amount"] = obj.amount / 100;
        rObj["job"] = obj.job.name;
        return rObj;
      });
      return timeEntries;
    }
  },
  created() {
    this.$store.dispatch("FETCH_TIME_ENTRIES");
  },
  methods: {
  }
};
  
</script>
<style scoped>
</style>
