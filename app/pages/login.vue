<template>
  <div class="col-12">
    <b-row>
      <b-col md="4" sm="12" offset-md="4">
        <div class="login">
          <div class="brand-logo d-flex justify-content-center p-1 mb-2">
            <b-img-lazy src="/logo-white.svg" />
          </div>

          <b-alert
            :show="dismissCountDown"
            dismissible
            variant="warning"
            @dismissed="dismissCountDown = 0"
            @dismiss-count-down="countDownChanged"
          >
            <label>
              {{ this.message }}
            </label>
            
          </b-alert>


          <b-form @submit.stop.prevent="login" class="text-left">
            <b-form-group
              id="form-group-email"
              label="Email address"
              label-for="input-1"
            >
              <b-skeleton type="input" v-if="this.loading"></b-skeleton>
              <b-form-input
                id="email"
                v-model="$v.form.email.$model"
                :state="validateState('email')"
                type="email"
                v-else
                aria-describedby="email-feedback"
              ></b-form-input>
              
              <b-form-invalid-feedback
                v-if="!$v.form.email.required"
                id="email-feedback"
                >กรุณากรอก Email</b-form-invalid-feedback
              >
              <b-form-invalid-feedback
                v-if="!$v.form.email.email"
                id="email-feedback"
                >รูปแบบ Email ไม่ถูกต้อง</b-form-invalid-feedback
              >
            </b-form-group>

            <b-form-group
              id="input-group-2"
              label="Password"
              label-for="password"
            >
            <b-skeleton type="input" v-if="this.loading"></b-skeleton>
              <b-form-input
                id="password"
                v-model="$v.form.password.$model"
                :state="validateState('password')"
                type="password"
                v-else
                aria-describedby="password-feedback"
              ></b-form-input>
              <b-form-invalid-feedback
                v-if="!$v.form.password.required"
                id="password-feedback"
                >กรุณาระบุรหัสผ่าน</b-form-invalid-feedback
              >
              <b-form-invalid-feedback
                v-if="!$v.form.password.minLength"
                id="password-feedback"
                >รหัสผ่านต้องมีอย่างน้อย
                {{
                  $v.form.password.$params.minLength.min
                }}
                ตัวอักษร</b-form-invalid-feedback
              >
            </b-form-group>
            <div class="text-center">
              <b-button type="submit" :disabled="this.loading" variant="primary"
                >Login
                <b-spinner
                  small
                  variant="success"
                  label="Spinning"
                  v-if="this.loading"
                ></b-spinner>
              </b-button>
              <b-button
                type="button"
                @click="resetForm()"
                :disabled="this.loading"
                variant="danger"
                >Reset</b-button
              >
              <p>
                <NuxtLink to="/" class="tex-center">กลับหน้าหลัก</NuxtLink>
              </p>
            </div>
          </b-form>
        </div>
      </b-col>
    </b-row>
    
  </div>
</template>
<script>
import { validationMixin } from "vuelidate";
import {
  required,
  minLength,
  maxLength,
  email,
} from "vuelidate/lib/validators";
export default {
  name: "LoginPage",
  layout: "login",
  mixins: [validationMixin],
  data() {
    return {
      loading: false,
      form: {
        email: null,
        password: null,
      },
      dismissSecs: 7,
      dismissCountDown: 0,
      showDismissibleAlert: false,
      message: null,
    };
  },
  validations: {
    form: {
      email: {
        required,
        email,
      },
      password: {
        required,
        minLength: minLength(6),
        maxLength: maxLength(100),
      },
    },
  },
  async fetch() {
    if(this.$auth.loggedIn){
      this.$router.push('/');
    }
  },
  methods: {
    countDownChanged(dismissCountDown) {
      this.dismissCountDown = dismissCountDown;
    },
    showAlert() {
      this.dismissCountDown = this.dismissSecs;
    },
    validateState(name) {
      const { $dirty, $error } = this.$v.form[name];
      return $dirty ? !$error : null;
    },
    resetForm() {
      this.form = {
        email: null,
        password: null,
      };

      this.$nextTick(() => {
        this.$v.$reset();
      });
    },
    async login() {
      this.$v.form.$touch();
      if (this.$v.form.$anyError) {
        return;
      }
      this.loading = true;
      
      await this.$auth
        .loginWith("laravelJWT", {
          data: { email: this.form.email, password: this.form.password },
        })
        .then(() => {
          
          this.loading = false;
        })
        .catch(err => {
          this.loading = false;
          this.message = err.message;
          this.showAlert();
        });
    },
    async logout() {
      await this.$auth
        .logout()
        .then((result) => {
          console.log(result);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
<style lang="css">
.login {
  position: relative;
  top: 50%;
}
.brand-logo {
  background-color: #0f0e9f;
}
</style>
