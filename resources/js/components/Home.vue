<template>
    <b-container>
        <b-row>
            <!--<b-table striped hover :items="jokes"></b-table>-->
            <div>
                <b-form-select v-model="selected" :options="workerOptions" class="mb-3" />
                <div>Selected: <strong>{{ selected }}</strong></div>
            </div>
        </b-row>
        <b-row>
            <!--<b-button @click="getStuff" variant="primary">Click Me</b-button>-->
        </b-row>
    </b-container>
</template>
<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                selected: null,
                workers: [],
                workerOptions: []
            };
        },
        created() {
            this.getWorkers();
        },
        methods: {
            createWorkerOptions: function (){
                this.workerOptions = this.workers.map( function (obj) {
                    var rObj = {};
                    rObj['value'] = obj.id;
                    rObj['text'] = obj.forename + " " + obj.last_name;
                    return rObj; });
                this.workerOptions.unshift({ value: null, text: 'Select a worker' });
            },

            getWorkers: function (){
                axios.get('http://www.jkl.com/api/workers')
                    .then(response => {
                        this.workers = response.data;
                        this.createWorkerOptions();
                    }).catch(function (error) {
                    console.log(error);
                });
            }
        },
    }
</script>
<style scoped>

</style>
