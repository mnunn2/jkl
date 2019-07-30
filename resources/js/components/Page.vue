
<template>
  <v-layout align-center justify-center>
    <v-flex xs10 sm7 m3>
      <h1>{{ greeting }}</h1>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  data() {
    return {
      greeting: "Hi there"
    };
  },
  computed: {
  },
  created() {
  },
  methods: {
  }
};
  
</script>
<style scoped>
</style>
