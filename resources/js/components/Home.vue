<template>
  <v-container v-if="workerOptions">
    <v-form ref="form">
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
      <v-dialog
        ref="dialog"
        v-model="modal2"
        :return-value.sync="time"
        persistent
        lazy
        full-width
        width="290px"
      >
        <v-text-field
          slot="activator"
          v-model="time"
          label="Enter hours"
          prepend-icon="access_time"
          readonly
        ></v-text-field>
        <v-time-picker v-if="modal2" v-model="time" actions :allowed-minutes="allowedStep">
          <v-spacer></v-spacer>
          <v-btn flat color="primary" @click="modal2 = false">Cancel</v-btn>
          <v-btn flat color="primary" @click="$refs.dialog.save(time)">OK</v-btn>
        </v-time-picker>
      </v-dialog>
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
  </v-container>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      formData: {
        worker_id: "",
        job_id: "",
        hours: "",
        date: "",
        type: "fred"
      },
      jobOptions: [],
      show: true,
      modal2: false,
      menu2: false,
      date: new Date().toISOString().substr(0, 10),
      time: null
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
      // format the hours as a float
      let hoursMinutes = this.time.split(/[.:]/);
      let hours = parseInt(hoursMinutes[0], 10);
      let minutes = hoursMinutes[1] ? parseInt(hoursMinutes[1], 10) : 0;
      this.formData.hours = hours + minutes / 60;
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
    },
    allowedStep: m => m % 30 === 0
  }
};
</script>
<style>
.v-time-picker-title__ampm {
  display: none;
}
.v-time-picker-title {
  justify-content: center;
}
</style>
