<template>
  <b-container>
    <b-row>
      <!--<b-table striped hover :items="jokes"></b-table>-->
      <div v-if="workerOptions">
        <b-form-select v-model="workerSelected" :options="workerOptions" class="mb-3"/>
        <div>
          Selected:
          <strong>{{ workerSelected }}</strong>
        </div>
      </div>
    </b-row>
    <b-row>
      <b-form-select
        @change="createJobOptions"
        v-model="projectSelected"
        :options="projectOptions"
        class="mb-3"
      />
      <div>
        Selected:
        <strong>{{ projectSelected }}</strong>
      </div>
      <!--<b-button @click="getStuff" variant="primary">Click Me</b-button>-->
    </b-row>
    <b-row>
      <b-form-select v-model="jobSelected" :options="jobOptions" class="mb-3"/>
      <div>
        Selected:
        <strong>{{ jobSelected }}</strong>
      </div>
      <!--<b-button @click="getStuff" variant="primary">Click Me</b-button>-->
    </b-row>
    <b-row>
    </b-row>
  </b-container>
</template>
<script>
import axios from "axios";

export default {
  computed : {

    workerOptions() {
      let workerOptions = this.$store.state.workers.map(function(obj) {
        var rObj = {};
        rObj["value"] = obj.id;
        rObj["text"] = obj['forename'] + " " + obj['last_name'];
        return rObj;
      });
      workerOptions.unshift({ value: null, text: "Select a worker" });
      return workerOptions;
    },

    projectOptions() {
      let projectOptions = this.$store.state.projects.map(function(obj) {
        var rObj = {};
        rObj["value"] = obj.id;
        rObj["text"] = obj['name'];
        return rObj;
      });
      projectOptions.unshift({ value: null, text: "Select a project" });
      return projectOptions;
    }

  },

  data() {
    return {
      projectSelected: null,
      workerSelected: null,
      jobSelected: null,
      jobOptions: [],
    };
  },
  created() {
    this.$store.dispatch('FETCH_WORKERS');
    this.$store.dispatch('FETCH_PROJECTS');
    this.$store.dispatch('FETCH_JOBS');
  },
  methods: {

    createJobOptions: function(projId) {
      // calling the function from @change without parenthesis
      // automatically passes the value of selected item
      this.jobOptions = this.$store.state.jobs
        .filter(function(obj) {
          if (obj.project_id === projId) {
            return true;
          }
        })
        .map(function(obj) {
          var rObj = {};
          rObj["value"] = obj.id;
          rObj["text"] = obj.name + ", " + obj.description;
          return rObj;
        });
      this.jobOptions.unshift({ value: null, text: "Select a job" });
    },

  }
};
</script>
<style scoped>
</style>
