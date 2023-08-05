<template>
  <v-container fluid fill-height class="d-flex align-center">
    <v-row class="d-flex justify-center">
      <v-col cols="3">
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-text-field
            v-model="amount"
            type="text"
            
            label="尋找您所想要的書籍"
            required
            outlined
            solo
          ></v-text-field>
          <v-btn type="button" v-bind:disabled="amount.trim() === ''" rounded @click="updateData"
            >GoGoGo</v-btn
          >
        </v-form>
      </v-col>
    </v-row>
        <template v-if="!isLoading">
      <v-row>
      <span class="row d-flex justify-center">{{ searchMessage }}</span>
      </v-row>
      <v-row v-for="i in rowSize" :key="i">
        <v-col v-for="n in getColoumNumber(i)" :key="n">
          <v-card class="mx-auto my-12" max-width="380" max-height="550">
            <a
              ><v-img
                contain
                max-height="250"
                :src="getImagePath(products[(i - 1) * 3 + n - 1])"
            /></a>
            <v-card-title>{{
              products[(i - 1) * 3 + n - 1].Name
            }}</v-card-title>
            <v-card-subtitle class="text-start">
              賣家：{{ products[(i - 1) * 3 + n - 1].sellerID }}
            </v-card-subtitle>
            <v-card-text class="text-start">
              ISBN： {{ products[(i - 1) * 3 + n - 1].ISBN }}
            </v-card-text>
            <v-card-text class="text-start">
              NT$ {{ products[(i - 1) * 3 + n - 1].price }}
            </v-card-text>
            <v-card-text>
              <div class="text-left">
                {{ products[(i - 1) * 3 + n - 1].Description }}
              </div>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="deep-purple lighten-2"
                text
                @click="addToCart(products[(i - 1) * 3 + n - 1])"
              >
                Add to Cart
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </template>
  </v-container>
</template>

<script>
import { mapGetters } from "vuex";
// @ is an alias to /src
import { imgageHost } from "@/config/config";
export default {
  data() {
    return {
      valid: true,
      amount: "",
      text: "",
      isSuccess: this.IsUpdateSuccess,
      isLoading: true,
      rowSize: 0,
      category: this.$route.query.category,
      searchMessage: "",
      searchQuery: '',
      selectedItem: null,
      isVisible: false,
    };
  },
    computed: {
    ...mapGetters({ products: "products/Items" })
  },
  watch: {
    text:{
      handler: async function(){
        this.isLoading = true;
        await this.loadData();
        console.log("Deposit Called");
        this.isLoading = false;
      }
    }
  },
  async created() {
    await this.initializeData();
    this.isLoading = false;
  },
  methods: {
    async initializeData() {
      console.log("initializeData");
      await this.$store.dispatch("products/getAllItems", this.category);
      this.rowSize = Math.ceil(
        this.products.length < 3 ? 1 : this.products.length / 3
      );
    },
    async loadData() {
      await this.$store.dispatch("products/getItemsByName", this.amount);
      console.log("loadData");
      try{
      if (this.products.length>0)
        this.searchMessage = "共搜尋到"+this.products.length+"筆資料";
        this.rowSize = Math.ceil(
        this.products.length < 3 ? 1 : this.products.length / 3
      );
      }
      catch(exception){
        this.searchMessage = "查無資料";
        this.rowSize=0;
      }
      console.log(this.searchMessage);

    },
    async updateData() {
      this.text = this.amount;
      this.searchMessage = "";
      console.log("update");
    },
    getImagePath(product) {
      if (!product) return "https://www.pixiv.net/artworks/86483702";
      return `${imgageHost}/${product.ImageURL.replace("./img/", "")}`;
    },
    getColoumNumber(index) {
      const length = this.products.length;
      if ((length - index * 3) % 3 >= 0) return 3;
      else if (length - index * 3 < 0) return length - index * 3 + 3;
      else return length - index * 3;
    },
    addToCart(product) {
      this.$store.dispatch("shoppingCart/addProductToCart", product);
    }
  }
};
</script>

<style scoped lang="scss">
.my-from {
  height: 800px;
}

.dropdown-wrapper{
  max-width: 360;
  position: relative;
  margin: 0 auto;

  .selected-item{
    height: 60px;
    border: 2px solid;
    border-radius: 5px;
    padding: 5px 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 18px;
    font-weight: 500;
  }

  .dropdown-popover{
    position: absolute;
    border: 2px solid lightgray;
    top: 46px;
    left: 0;
    right: 0;
    background-color: #fff;
    max-width: 100%;
    padding: 10px;

    input {
      width: 95%;
      height: 30px;
      border:  2px solid lightgray;
      font-size: 16px;
      padding-left: 8px;
    }

    .options{
      width: 100%;

      ul{
        list-style: none;
        text-align: left;
        padding-left: 8px;
        max-height: 100px;
        overflow-y: scroll;
        overflow-x: hidden;

        li{
          width: 100%;
          border-bottom: 1px solid lightgray;
          padding: 10px;
          background-color: #f1f1f1;
          cursor: pointer;
          font-size: 25px;
          font-weight: 600;
          &:hover{
            background-color: rgb(131, 146, 125);
            color: #fff;
            font-weight: bold;
          }
        }
      }
    }
  }
}
</style>