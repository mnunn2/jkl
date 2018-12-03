<template>
  <b-container>
    <b-form @submit="addTimeEntry" @reset="onReset" v-if="workerOptions">
      <b-form-group id="selectWorkerGroup"
                    label="Select Worker:"
                    label-for="workerSelect">
        <b-form-select id="workerSelect"
                      :options="workerOptions"
                      required
                      v-model="form.worker_id">
        </b-form-select>
      </b-form-group>
      <b-form-group id="selectProjectGroup"
                    label="Select Project:"
                    label-for="projectSelect">
        <b-form-select id="projectSelect"
                    @change="createJobOptions"
                    :options="projectOptions">
        </b-form-select>
      </b-form-group>
      <b-form-group id="selectJobGroup"
                    label="Select Job:"
                    label-for="jobSelect">
        <b-form-select id="jobSelect"
                    :options="jobOptions"
                    v-model="form.job_id">
        </b-form-select>
      </b-form-group>
      <b-form-group id="timeInputGroup"
                    label="Enter Hours:"
                    label-for="timeInput"
                    description="Plese enter time in hours and mins.">
        <b-form-input id="timeInput"
                      type="number"
                      v-model="form.hours"
                      required>
        </b-form-input>
      </b-form-group>

      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
  </b-container>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      form: {
        worker_id: '',
        job_id: '',
        hours: '',
        date: "2018-12-03",
        amount: 100,
        type: "fred"
      },
      jobOptions: [],
    };
  },
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

  created() {
    this.$store.dispatch('FETCH_WORKERS');
    this.$store.dispatch('FETCH_PROJECTS');
    this.$store.dispatch('FETCH_JOBS');
  },
  methods: {

    onReset: function() {
      console.log('reset');
    },

    addTimeEntry: function(e) {
      e.preventDefault();
      this.$store.dispatch('SAVE_TIME_ENTRY', this.form);
    },

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
