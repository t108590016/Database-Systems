<template>
  <v-container fluid fill-height class="d-flex align-start">
    <v-col>
      <v-row justify="center" class="mt-5">
        <h1>對話視窗</h1>
      </v-row>
      <v-row justify="center">
        <v-col cols="6">
          <v-card outlined class="pa-10">
            <v-form
              ref="form"
              v-model="valid"
              lazy-validation
              @submit.prevent="handleSubmit"
            >
              <v-text-field
                v-model="reciever"
                :rules="RecieverRules"
                label="收件者"
                required
                prepend-inner-icon="mdi-alpha-a"
              ></v-text-field>
              <v-text-field
                v-model="topic"
                :rules="[v => !!v || 'Description is required']"
                label="標題"
                required
                prepend-inner-icon="mdi-information-variant "
              ></v-text-field>

              <v-text-field
                v-model="content"
                :rules="[v => !!v || 'Description is required']"
                label="內容"
                required
                prepend-inner-icon="mdi-information-variant "
              ></v-text-field>
              <v-row justify="center" class="mt-5">
                <v-btn
                  :disabled="!valid"
                  color="success"
                  class="mr-4"
                  type="submit"
                >
                  Submit
                </v-btn>
                <v-btn color="pink" class="mr-4 white--text" @click="reset">
                  Clear
                </v-btn>
              </v-row>
            </v-form>
          </v-card>
        </v-col>
      </v-row>
    </v-col>
  </v-container>
</template>

<script>
import { PublishProduct } from "@/api/msnrecordmyself";
import { mapGetters } from "vuex";
export default {
  data: () => ({
    valid: true,
    reciever: "",
    RecieverRules: [
      v => !!v || "ID is required",
      v => (v && v.length == 9) || "ID must be equal to 9 characters"
    ],
    topic: "",
    content: "",
  }),
  computed: {
    ...mapGetters({ UserId: "login/Id" })
  },
  methods: {
    async validate() {
      this.$refs.form.validate();
    },
    reset() {
      this.$refs.form.reset();
    },
    async handleSubmit() {
      if (this.$refs.form && this.$refs.form.validate()) {
        const res = await PublishProduct({
          reciever: this.reciever,
          sender: this.UserId,
          topic: this.topic,
          content: this.content,
        });
        if (res.msg === "success") {
          this.$router.push({ name: "MsnRecordMyself" });
        }
      }
    }
  }
};
</script>

<style></style>
