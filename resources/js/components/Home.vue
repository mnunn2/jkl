<template>
    <b-container>
        <b-row>
            <!--<b-table striped hover :items="jokes"></b-table>-->
            <div>
                <b-form-select v-model="workerSelected" :options="workerOptions" class="mb-3" />
                <div>Selected: <strong>{{ workerSelected }}</strong></div>
            </div>
        </b-row>
        <b-row>
            <b-form-select @change="getJobsPerProj" v-model="projectSelected" :options="projectOptions" class="mb-3" />
            <div>Selected: <strong>{{ projectSelected }}</strong></div>
            <!--<b-button @click="getStuff" variant="primary">Click Me</b-button>-->
        </b-row>
        <b-row>
            <b-form-select v-model="jobSelected" :options="jobOptions" class="mb-3" />
            <div>Selected: <strong>{{ jobSelected }}</strong></div>
            <!--<b-button @click="getStuff" variant="primary">Click Me</b-button>-->
        </b-row>
    </b-container>
</template>
<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                projectSelected: null,
                workerSelected: null,
                jobSelected: null,
                projects: [],
                workers: [],
                jobs: [],
                workerOptions: [],
                jobOptions: [],
                projectOptions: []
            };
        },
        created() {
            this.getProjects();
            this.getWorkers();
        },
        methods: {
            createWorkerOptions: function (params){
                this.workerOptions = this.workers.map( function (obj) {
                    var rObj = {};
                    rObj['value'] = obj.id;
                    rObj['text'] = obj[params[0]] + " " + obj[params[1]];
                    return rObj; });
                this.workerOptions.unshift({ value: null, text: 'Select a worker' });
            },

            createProjectOptions: function (params){
                this.projectOptions = this.projects.map( function (obj) {
                    var rObj = {};
                    rObj['value'] = obj.id;
                    rObj['text'] = obj[params[0]];
                    return rObj; });
                this.projectOptions.unshift({ value: null, text: 'Select a project' });
            },

            createJobOptions: function (params){
                this.jobOptions = this.jobs.map( function (obj) {
                    var rObj = {};
                    rObj['value'] = obj.id;
                    rObj['text'] = obj[params[0]] + " " + obj[params[1]];
                    return rObj; });
                this.jobOptions.unshift({ value: null, text: 'Select a job' });
            },

            getProjects: function (){
                axios.get('http://www.jkl.com/api/projects')
                    .then(response => {
                        this.projects = response.data;
                        this.createProjectOptions(['name']);
                    }).catch(function (error) {
                    console.log(error);
                });
            },

            getWorkers: function (){
                axios.get('http://www.jkl.com/api/workers')
                    .then(response => {
                        this.workers = response.data;
                        this.createWorkerOptions(['forename', 'last_name']);
                    }).catch(function (error) {
                    console.log(error);
                });
            },

            getJobsPerProj: function (projId){
                // calling the function without parenthesis automatically
                // passes the value of selected item
                console.log('projid ', projId);
                axios.get('http://www.jkl.com/api/jobs')
                    .then(response => {
                        this.jobs = response.data;
                        this.createJobOptions(['name', 'description']);
                    }).catch(function (error) {
                    console.log(error);
                });
            }
        },
    }
</script>
<style scoped>

</style>
