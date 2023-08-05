<template>
  <v-container fluid fill-height class="d-flex align-start">
    <v-col>
      <v-row justify="center" class="mt-5">
        <h1>Add New Product</h1>
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
              <v-select
                v-model="ISBN"
                :rules="ISBNRules"
                :items="isbns"
                label="ISBN"
                required
                prepend-inner-icon="mdi-alpha-a"
              ></v-select>

              <v-text-field
                v-model="price"
                :rules="priceRules"
                label="Price"
                required
                prepend-inner-icon="mdi-currency-usd"
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
import { PublishProduct } from "@/api/myproduct";
import { GetProductsCategories, GetBookISBN } from "@/api/home";
import { mapGetters } from "vuex";

export default {
  data: () => ({
    valid: true,
    isbns: [],
    ISBN: "",
    ISBNRules: [
      v => !!v || "ISBN is required",
      v => /^[1-9]+[0-9]*$/.test(v) || "ISBN must be valid",
      v => (v && v.length <= 13) || "ISBN must be less than 13 characters"
    ],
    price: "",
    priceRules: [
      v => !!v || "Price is required",
      v => /^[1-9]+[0-9]*$/.test(v) || "Price must be valid"
    ]
  }),
  async created() {
    this.categories = (await GetProductsCategories()).categories;
    this.isbns = (await GetBookISBN()).ISBN;
  },
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

          const res = await PublishProduct(
            this.ISBN,
            this.UserId,
            this.price
          );
          if (res.msg === "success") {
            this.$router.push({ name: "MyProduct" });
          }
      }
    }
  }
};
</script>

<style></style>
