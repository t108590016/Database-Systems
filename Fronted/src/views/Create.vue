<template>
  <v-container fill-height fluid class="d-flex align-center ">
    <v-row class="d-flex justify-center">
      <v-col cols="4">
        <div class="text-h3 text-left my-3">Create</div>
        <v-form
          ref="form"
          v-model="valid"
          lazy-validation
          class="form"
            @submit.prevent="handleSubmit"
        >
          <v-text-field
            v-model="user.studentNum"
            label="Student Number"
            :rules="studentNumberRules"
            outlined
          ></v-text-field>
          <v-text-field
            v-model="user.password"
            label="Password"
            type="password"
            :rules="passwordRules"
            outlined
          ></v-text-field>
          <v-text-field
            v-model="user.checkPassword"
            label="CheckPassword"
            type="password"
            :rules="passwordRules"
            outlined
          ></v-text-field>
            <v-text-field
            v-model="user.name"
            label="Name"
            :rules="nameRules"
            outlined
          ></v-text-field>
        <v-text-field
            v-model="user.phoneNum"
            label="PhoneNum"
            :rules="phoneNumRules"
            outlined
          ></v-text-field>
        <v-text-field
            v-model="user.department"
            label="Department"
            :rules="departmentRules"
            outlined
          ></v-text-field>
          <div v-show="!valid" class="text-left">
            <span class="red--text text--lighten-1"
              >Student Number or Password error</span
            >
          </div>
          <v-btn
            class="login-btn"
            type="submit"
            :disabled="isLoading"
            color="success"
            >Submit</v-btn
          >
        </v-form>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { Create } from "@/api/login";
export default {
  data() {
    return {
      user: {
        studentNum: "",
        password: "",        
        checkPassword: "",
        name: "",
        phoneNum: "",
        department: ""
      },
      valid: true,
      isLoading: false,
      nameRules: [        
        v => !!v || "Name is required"
      ],
      departmentRules: [        
        v => !!v || "Department is required",
        v => /^[A-Z]*$/.test(v) || "Department can only contain upper latters"
      ],
      phoneNumRules: [        
        v => !!v || "Phone number is required",
        v => /^[0-9]*$/.test(v) || "Phone number can only contain numbers",
        v => (v && v.length == 10) || "Phone number must be equal to 10 characters"
      ],
      passwordRules: [
        v => !!v || "Password is required",
        v => (v && v.length >= 5) || "password must be more than 5 characters"
      ],
      studentNumberRules: [
        v => !!v || "Student number is required",
        v => (v && v.length == 9) || "password must be equal to 9 characters"
      ]
    };
  },
  methods: {
    async handleSubmit() {
      if (this.$refs.form && this.$refs.form.validate()) {
        const res = await Create({
            studentNum: this.user.studentNum,
            password: this.user.password,
            checkPassword: this.user.checkPassword,
            name: this.user.name,
            phoneNum: this.user.phoneNum,
            department: this.user.department
          });
          console.log(res.msg);
          if (res.msg === "success") {
            this.$router.push({ name: "Login" });
          }
      }
    }
  }
};
</script>

<style></style>
