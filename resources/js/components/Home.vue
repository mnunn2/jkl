<template>
    <b-container>
        <b-row>
        <div v-for="joke in jokes" :key="joke.id">
            <b-card v-bind:title="joke.id"
                    img-src="https://placeimg.com/100/100/nature"
                    tag="article"
                    style="max-width: 20rem;"
                    class="mb-2">
                <p class="card-text">{{ joke.forename }}</p>
                <p class="card-text">{{ joke.last_name }}</p>
            </b-card>
        </div>
        </b-row>
        <b-row>
            <b-button @click="getStuff" variant="primary">Click Me</b-button>
        </b-row>
    </b-container>
</template>
<script>
    import axios from 'axios';
    export default {
        props : ['title'],
        data() {
            return {
                jokes: []
            };
        },
        methods: {
            getStuff: function () {
                axios.get('http://www.jkl.com/api/workers')
                    .then(response => {
                        this.jokes = response.data;
                        console.log(response.data);
                    }).catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>
<style scoped>

</style>
