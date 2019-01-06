<template>
  <v-layout align-center justify-center>
    <v-flex xs10 sm7 m3>
      <v-form v-if="workerOptions" ref="form">
        <v-select
          id="workerSelect"
          label="Select Worker"
          :items="workerOptions"
          v-model="formData.worker_id"
        ></v-select>
        <v-select
          id="projectSelect"
          label="Select Project"
          @change="createJobOptions"
          :items="projectOptions"
        ></v-select>
        <v-select id="jobSelect" label="Select Job" :items="jobOptions" v-model="formData.job_id"></v-select>
        <!-- <v-text-field id="timeInput" type="number" v-model="formData.hours" required></v-text-field> -->
        <v-layout wrap justify-space-between>
          <v-flex xs3>
            <v-select v-model="formData.hours" :items="hours" label="Hours">
              <template slot="selection" slot-scope="{item}">
                {{item}}
                <span v-if="halfHour === true" class="grey--text caption">&nbsp; + .5</span>
              </template>
            </v-select>
          </v-flex>
          <v-flex xs4>
            <v-switch :label="`half Hour: `" v-model="halfHour"></v-switch>
          </v-flex>
        </v-layout>

        <v-menu
          :close-on-content-click="false"
          v-model="menu2"
          :nudge-right="40"
          lazy
          transition="scale-transition"
          offset-y
          full-width
          min-width="290px"
        >
          <v-text-field
            slot="activator"
            v-model="date"
            label="Enter date"
            prepend-icon="event"
            readonly
          ></v-text-field>
          <v-date-picker v-model="date" @input="menu2 = false"></v-date-picker>
        </v-menu>
        <v-btn @click="submit">Submit</v-btn>
      </v-form>
      <v-spacer></v-spacer>
    </v-flex>
  </v-layout>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      halfHour: false,
      hours: [1, 2, 3, 4, 5, 6, 7, 8],
      formData: {
        worker_id: "",
        job_id: "",
        hours: "0",
        date: "",
        type: "fred"
      },
      jobOptions: [],
      show: true,
      modal2: false,
      menu2: false,
      date: new Date().toISOString().substr(0, 10),
      time: null,
    };
  },
  computed: {
    workerOptions() {
      let workerOptions = this.$store.state.workers.map(function(obj) {
        var rObj = {};
        rObj["value"] = obj.id;
        rObj["text"] = obj["forename"] + " " + obj["last_name"];
        return rObj;
      });
      return workerOptions;
    },

    projectOptions() {
      let projectOptions = this.$store.state.projects.map(function(obj) {
        var rObj = {};
        rObj["value"] = obj.id;
        rObj["text"] = obj["name"];
        return rObj;
      });
      return projectOptions;
    }
  },

  created() {
    this.$store.dispatch("FETCH_WORKERS");
    this.$store.dispatch("FETCH_PROJECTS");
    this.$store.dispatch("FETCH_JOBS");
  },
  methods: {
    formReset: function(e) {
      this.$refs.form.reset();
    },
    submit: function(e) {
      // add half hour
      if (this.halfHour) {
        this.formData.hours += 0.5;
      }
      this.formData.date = this.date;
      this.$store.dispatch("SAVE_TIME_ENTRY", this.formData);
      this.$nextTick(() => this.formReset());
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
    }
  }
};
</script>
<style>
</style>
