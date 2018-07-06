<template >
<v-app> 
 <v-layout justify-center class="main-frame">
    <v-flex xs12 sm10 md8 lg6>
    <h1 lg><center>Registration</center></h1>
    <br>
    <br>
      <v-card ref="form">
        <v-card-text>
          <v-text-field
            ref="firstname"
            v-model="firstname"
            v-validate="'required|max:255|alpha'"
            :error-messages="errors.collect('firstname')"
            name="firstname"
            label="Firstname"
            placeholder="Joshua"
            required
          ></v-text-field>
          
          <v-text-field
            ref="lastname"
            v-validate="'required|max:255|alpha'"
            v-model="lastname"
            :error-messages="errors.collect('lastname')"
            name="lastname"
            label="Lastname"
            placeholder="Perez"
            required
          ></v-text-field>

          <v-text-field
            ref="email"
            v-validate="'required|email'"
            :error-messages="errors.collect('email')"
            name="email"
            v-model="email"
            label="Email"
            placeholder="whatthejoshuaperez@gmail.com"
            required
          ></v-text-field>

          
          <v-text-field
          ref="password"
          v-model="password"
          v-validate="'required|min:8'"
          :error-messages="errors.collect('password')"
          :append-icon="e1 ? 'visibility' : 'visibility_off'"
          :append-icon-cb="() => (e1 = !e1)"
          :type="e1 ? 'password' : 'text'"
          name="password"
          label="Enter your password"
          hint="At least 8 characters"
        ></v-text-field>

        <v-text-field
          ref="password_confirmation"
          v-model="password_confirmation"
          v-validate="'required|min:8|confirmed:password'"
          :error-messages="errors.collect('password_confirmation')"
          :append-icon="e2 ? 'visibility' : 'visibility_off'"
          :append-icon-cb="() => (e2 = !e2)"
          :type="e2 ? 'password' : 'text'"
          name="password_confirmation"
          label="Re enter your password"
          hint="At least 8 characters"
        ></v-text-field>
        </v-card-text>
        <center> <vue-recaptcha sitekey="6LcqnmIUAAAAAKkKdQ8jhyhaanc7WKIlW0jJbzAf" @verify="RecaptchaAsVerified()"></vue-recaptcha> </center>
        <v-divider class="mt-5"></v-divider>
        <v-card-actions>
          <v-btn href="/" flat>Cancel</v-btn>
          <v-spacer></v-spacer>
          <v-slide-x-reverse-transition>
            <v-tooltip
              v-if="formHasErrors"
              left
            >
                slot="activator"
              <v-btn
                icon
                class="my-0"
                @click="resetForm"
              >
                <v-icon>refresh</v-icon>
              </v-btn>
              <span>Refresh form</span>
            </v-tooltip>
          </v-slide-x-reverse-transition>
         
          <v-btn color="primary" flat @click.prevent="postData()" v-show="!errors.has('firstname') && !errors.has('lastname') && !errors.has('email') && !errors.has('password') && !errors.has('password_confirmation') && recaptchaVerified">Submit</v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>
  </v-layout>
  </v-app>
</template>
<script>
import VueRecaptcha from 'vue-recaptcha'
 export default {
  components: { VueRecaptcha },
 $_veeValidate: {
      validator: 'new'
    },
    data: () => ({
      loader:false,
      errorMessages: [],
      firstname: null,
      lastname: null,
      email: null,
      password: null,
      password_confirmation: null,
      e1: true,
      e2: true,
      formHasErrors: false,
      recaptchaVerified: false,
      pleaseTickRecaptchaMessage: '',
    }),

    computed: {
      form () {
        return {
          firstname: this.firstname,
          lastname: this.lastname,
          email: this.email,
          password: this.password ,
          password_confirmation: this.password_confirmation
        }
      }
    },

    watch: {
      name () {
        this.errorMessages = []
      }
    },

    methods: {
      resetForm () {
        this.errorMessages = []
        this.formHasErrors = false

        Object.keys(this.form).forEach(f => {
          this.$refs[f].reset()
        })
      },
      postData() {
      this.loader = true;
      axios.post('/register', {
          firstname: this.firstname,
          lastname: this.lastname,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation
        }).then(response => {
         toastr.success('Confirmation link has been sent to your email.','SERVER')
         this.firstname = '';
         this.lastname = '';
         this.email = '';
         this.password = '';
         this.password_confirmation = '';
        }).catch(e => {
            toastr.error(e,'SERVER')
        });
      },
      RecaptchaAsVerified () {
        this.pleaseTickRecaptchaMessage = '';
        this.recaptchaVerified = true;
      },
      checkIfRecaptchaVerified() {
      if (!this.RecaptchaAsVerified) {
        this.pleaseTickRecaptchaMessage = 'Please tick recaptcha.';
        return true; // prevent form from submitting
      }
      alert('form would be posted!');
    }
    }
  }
</script>
