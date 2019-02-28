<template>
  <v-container>
    <v-layout align-start justify-start column fill-height>
      <br>
      <LoginForm title="Login"/>
    </v-layout>
  </v-container>
</template>

<script>
import axios from "axios";

import LoginForm from "../LoginForm.vue";
import Card from "../Card.vue";

export default {
  components: {
    LoginForm,
    Card
  },
  name: "login",
};
</script>

