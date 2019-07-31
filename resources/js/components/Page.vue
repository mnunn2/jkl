
<template>
  <v-layout align-center justify-center>
    <v-flex xs10 sm7 m3>
      <h1>{{ greeting }}</h1>
      <h1>{{ title }} is title and author name is {{ author.name }}</h1>
      <h1>{{ newTitle }}</h1>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  props: ['title', 'author'],
  data() {
    return {
      greeting: "Hi there",
      newTitle: this.title
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
