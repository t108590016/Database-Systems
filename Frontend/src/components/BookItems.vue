<template>
  <v-col>
    <v-row>
      <h1>書籍明細</h1>
    </v-row>
    <v-row>
      <v-card outlined max-width="850">
        <v-list-item v-if="BookItems.length === 0">
          <v-banner class="my-banner">
            查無書籍
          </v-banner>
        </v-list-item>
          <v-list-item :key="index">
            <v-row class="my-1">
              <v-col cols="3">
                <v-img
                  max-width="460px"
                  :src="getImagePath(BookItems.ImageURL)"
                ></v-img>
              </v-col>
              <v-col cols="5" class="text-color-info text-left" align-self="center">
                <h4>{{ BookItems.Name }}</h4>
                <span>ISBN：{{ BookItems.ISBN }}</span>
                <br>
                <span>敘述：{{ BookItems.Description }}</span>
              </v-col>
            </v-row>
          </v-list-item>
      </v-card>
    </v-row>
      <v-row class="my-2">
        <h1>以下有{{products.length}}筆此書的商品</h1>
      </v-row>
      <v-row>
        <v-card outlined max-width="1200">
          <template v-for="(product, index) in products">
            <v-list-item :key="index">
              <v-row class="my-1">
                  <span class="my-1 black--text">賣家：{{ product.sellerID }}&emsp;價錢：{{ currency }} {{ product.price }}&emsp;</span>
                   <span class="white--text">賣家</span>
                    <v-btn
                      color="pink"
                      class="white--text"
                      @click="addToCart(product)"
                    >
                      Add to shoppingCart
                    </v-btn>
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
</template>

<script>
import { imgageHost } from "@/config/config";
import { mapGetters } from "vuex";
import { GetSellingBook } from "@/api/myproduct";

export default {
  data() {
    return {       
      products: [],
      currency: "NT$" 
    };
  },
  async created() {
    await this.init();
  },
  computed: {
    ...mapGetters({ BookItems: "Bookinfo/Items" })

  },
  methods: {
    async init() {
      this.products = [];
      this.products.length = 0;
      console.log(this.BookItems.ISBN);
      this.products = (await GetSellingBook(this.BookItems.ISBN)).data;
      console.log(this.products);
    },
    addToCart(product) {
      console.log(product);
      this.$store.dispatch("shoppingCart/addProductToCart", product);
    },
    getImagePath(filename = "") {
      console.log(this.BookItems);
      return `${imgageHost}/${filename.replace("./img/", "")}`;
    }
  } 
};
</script>

<style>
.form-control {
  border: 1px solid rgba(0, 0, 0, 0.07) !important;
  height: 36px;
  min-height: 36px;
  width: 60px;
  min-width: 60px;
  box-shadow: none;
  border-radius: 0 !important;
}
.text-color-info{
  font-family:Microsoft JhengHei;
  font-weight:bold;
}
.my-btn {
  font-size: 14px !important;
  border: 1px solid #e8e9ea !important;
  background-color: white !important;
  border-radius: 0 !important;
}
.white--text{
  color: #f0ffff;
  font-size: 16px;
  font-family:Microsoft JhengHei;
  font-weight:bold;
}
.black--text{
  color: #000000;
  font-size: 16px;
  font-family:Microsoft JhengHei;
  font-weight:bold;
}
.my-banner {
  width: 850px;
  max-width: 850px;
}
</style>
