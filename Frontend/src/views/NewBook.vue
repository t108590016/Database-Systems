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
              <v-text-field
                v-model="ISBN"
                :rules="ISBNRules"
                label="ISBN"
                required
                prepend-inner-icon="mdi-alpha-a"
              ></v-text-field>
              <v-text-field
                v-model="name"
                label="name"
                required
                prepend-inner-icon="mdi-alpha-a"
              ></v-text-field>
              <v-select
                v-model="selectedCategory"
                :items="categories"
                :rules="[v => !!v || 'Category is required']"
                label="Category"
                required
                prepend-inner-icon="mdi-shape-outline "
              ></v-select>

              <v-text-field
                v-model="description"
                :rules="[v => !!v || 'Description is required']"
                label="Description"
                required
                prepend-inner-icon="mdi-information-variant "
              ></v-text-field>
              <v-file-input
                v-model="fileObject"
                :rules="fileInputRules"
                accept="image/png, image/jpeg, image/bmp"
                placeholder="Pick an image"
                prepend-icon="mdi-file-image-outline"
              ></v-file-input>
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
import { UploadFile, PublishBook } from "@/api/myproduct";
import { GetProductsCategories } from "@/api/home";
import { mapGetters } from "vuex";

export default {
  data: () => ({
    valid: true,
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
    ],
    selectedCategory: null,
    categories: [],
    description: "",
    inventory: "",
    inventoryRules: [
      v => !!v || "Inventory is required",
      v => /^[1-9]+[0-9]*$/.test(v) || "Inventory must be valid"
    ],
    fileObject: null,
    fileInputRules: [
      v => !!v || "image is required",
      value =>
        !value ||
        value.size < 5000000 ||
        "Avatar size should be less than 5 MB!"
    ]
  }),
  async created() {
    this.categories = (await GetProductsCategories()).categories;
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
        const imageRes = await UploadFile(this.fileObject);
        if (imageRes.success) {
          const res = await PublishBook({
            ISBN: this.ISBN,
            name: this.name,
            category: this.selectedCategory,
            description: this.description,
            imageLink: imageRes.imageLink
          });
          if (res.msg === "success") {
            this.$router.push({ name: "MyProduct" });
          }
        }
      }
    }
  }
};
</script>

<style></style>
