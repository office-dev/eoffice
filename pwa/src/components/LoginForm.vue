<template>
  <v-card elevation="4">
    <v-toolbar dark color="blue lighten-1" dense>
      <v-toolbar-title>Login</v-toolbar-title>
    </v-toolbar>
    <v-card-text>
      <v-form>
        <v-text-field
            id="username"
            prepend-icon="mdi-account"
            name="username"
            label="Username"
            type="text"
            v-model="username"
        />
        <v-text-field
            id="password"
            prepend-icon="mdi-lock"
            name="password"
            label="Password"
            type="password"
            v-model="password"
        />
      </v-form>
    </v-card-text>
    <v-card-actions>
      <v-btn color="green" dark @click="handleLogin">
        <v-icon left>mdi-login</v-icon>
        Login
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
import {mapGetters, mapActions} from "vuex";

export default {
  name: "LoginForm",
  data: ()=> ({
    drawer: null,
    username: null,
    password: null,
  }),
  computed: {
    ...mapGetters({
      error: 'auth/loginError',
      loggingIn: "auth/loggingIn"
    })
  },
  methods: {
    ...mapActions({
      login: 'auth/login',
      toggleLoading: 'ui/toggleLoading'
    }),
    handleLogin(){
      const payload = {
        username: this.username,
        password: this.password
      }
      this.toggleLoading();
      this.login(payload);
      this.toggleLoading();
    }
  }
}
</script>