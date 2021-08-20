<template>
  <v-app id="inspire">
    <v-main>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs8 sm8 md8>
            <login-form/>
          </v-flex>
        </v-layout>
      </v-container>
    </v-main>
  </v-app>
</template>
<script>
import LoginForm from "../components/LoginForm";

export default {
  name: "Login",
  components: {
    LoginForm,
  },
}
</script>