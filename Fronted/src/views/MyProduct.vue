<template>
  <v-container fluid fill-height class="d-flex align-center">
    <v-col class="mb-10">
      <v-row class="my-3" justify="center">
        <h1>My Product</h1>
      </v-row>
      <v-row justify="center">
        <h2>{{this.text}}</h2>
        <v-card outlined max-width="1200">
          <template v-for="(product, index) in products">
            <v-list-item :key="index">
              <v-row class="my-1">
                <v-col cols="3" align-self="center">
                  <v-img max-width="460px" :src="getImagePath(product)"></v-img>
                </v-col>
                <v-col cols="3" class="text-left" align-self="center">
                  <h4>{{ product.Name }}</h4>
                  <span>Price：{{ currency }} {{ product.price }}</span>
                  <br />
                  <span>ISBN：{{ product.ISBN }}</span>
                </v-col>
                <v-col cols="3" class="text-left">
                  <span> {{ product.Description }}</span>
                </v-col>
                <v-col align-self="center">
                  <v-row justify="center" class="mb-3">
                    <v-btn
                      color="pink"
                      class="white--text"
                      @click="handleDeleteProduct(product)"
                    >
                      DELETE
                    </v-btn>
                  </v-row>
                </v-col>
              </v-row>
            </v-list-item>
            <v-divider
              v-if="index < product.length"
              :key="index + Date.now()"
            ></v-divider>
          </template>
        </v-card>
      </v-row>
    </v-col>
  </v-container>
</template>  

<script>
import { imgageHost } from "@/config/config";
import { Getmyproduct, OffProduct } from "@/api/myproduct";
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      products: [],
      currency: "NT$",
      text: "沒有商品"
    };
  },
  async created() {
    await this.init();
  },
  computed: {
    ...mapGetters({ UserId: "login/Id" })
  },
  methods: {
    async init() {
      this.products = [];
      this.products.length = 0;
      this.products = (await Getmyproduct(this.UserId)).data;
    },
    getImagePath(product) {
      if (!product) return "https://www.pixiv.net/artworks/86483702";
      return `${imgageHost}/${product.ImageURL.replace("./img/", "")}`;
    },
    async handleDeleteProduct(product) {
      console.log(product.ISBN);
      if (product !== undefined && product !== null)
        await OffProduct(this.UserId, product.ISBN);
      this.products = (await Getmyproduct(this.UserId)).data;
    }
  },
  watch:{
    products:{
      handler: async function(){
        if (this.products.length > 0){
          this.text = "";
        }
        else{
          this.text = "沒有商品";
        }
      }
    }
  }
};
</script>

<style></style>
