<template>
<v-app>
  <v-container>
    <v-layout row class="text-xs-center" style="padding-top:300px; padding-left:450px;">
      <v-flex xs3 style="background-image: url('http://cdn.wallpapersafari.com/7/86/gqiGH7.jpg')">
      </v-flex>
      <v-flex xs4 class="grey lighten-4">
        <v-container class="text-xs-center">
          <v-card flat>
            <v-card-title primary-title>
              <h4>Login</h4>
            </v-card-title>
            <v-form>
            <v-text-field prepend-icon="person" name="email" label="Email" v-validate="'required|email'"
            :error-messages="errors.collect('email')"></v-text-field>
            <v-text-field prepend-icon="lock" name="password" label="Password" type="password" v-validate="'required|min:8'"
          :error-messages="errors.collect('password')"></v-text-field>
            <v-card-actions>
              <v-btn primary large block>Login</v-btn>
            </v-card-actions>
            </v-form>
          </v-card>
        </v-container>
      </v-flex>
    </v-layout>
  
  </v-container>
  </v-app>
</div>

</template>
<script>
 export default {
 
  }
</script>
