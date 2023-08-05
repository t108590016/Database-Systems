<template>
  <v-container fluid fill-height class="d-flex align-start">
    <v-row v-if="isLoading">
      <v-col cols="8" offset="2">
        <Loading :is-loading="isLoading" />
      </v-col>
      
    </v-row>
        <v-row class="d-flex justify-center">
      <v-col cols="3">
          
          <v-text-field
            v-model="keyword"
            type="text"
            @keyup.enter="updateData"
            label="尋找您所想要的書籍"
            required
            outlined
            solo
          ></v-text-field>
          <v-btn type="button" v-bind:disabled="keyword.trim() === ''" rounded @click="updateData"
            >GoGoGo</v-btn
          >
        
              </v-col>
    </v-row>
    <template v-if="!isLoading">

      <v-row v-for="i in rowSize" :key="i">
        <v-col v-for="n in getColoumNumber(i)" :key="n">
          <v-card class="mx-auto my-12" max-width="380" max-height="550">
            <a class="colcardbeatify" href="/bookinfo"
              ><v-img
              class="colcardbeatify"
                contain
                max-height="250"
                :src="getImagePath(products[(i - 1) * 3 + n - 1])"
                @click="SetBook(products[(i - 1) * 3 + n - 1])"
            /></a>
            <v-card-title class="text-color-info">{{
              products[(i - 1) * 3 + n - 1].Name
            }}</v-card-title>
            <v-card-text class="text-start text-color-info">
              ISBN： {{ products[(i - 1) * 3 + n - 1].ISBN }}
            </v-card-text>
            <v-card-text class="text-left text-color-info">
                {{ products[(i - 1) * 3 + n - 1].Description }}
            </v-card-text>
            
          </v-card>
        </v-col>
      </v-row>
    </template>
  </v-container>
</template>

<script>
// @ is an alias to /src
import { imgageHost } from "@/config/config";
import { mapGetters } from "vuex";
import Loading from "@/components/Loading";

export default {
  name: "Home",
  components: { Loading },
  data() {
    return {
      keyword: "",
      text: "",
      isLoading: true,
      rowSize: 0,
      category: this.$route.query.category
    };
  },
  computed: {
    ...mapGetters({ products: "products/Items" })
  },
  watch: {
    $route: async function() {
      this.isLoading = true;
      this.category = this.$route.query.category;
      await this.loadData();
      this.isLoading = false;
    },
    text:{
      handler: async function(){
        if (this.text != ""){
        this.isLoading = true;
        await this.searchData();
        this.isLoading = false;
        }
      }
    },
    category:{
      handler: async function(){
        this.text = "";
        this.keyword = "";
      }
    }
  },
  async created() {
    await this.loadData();
    this.isLoading = false;
  },
  methods: {
    async loadData() {
      await this.$store.dispatch("products/getAllBooks", this.category);
      this.rowSize = Math.ceil(
        this.products.length < 3 ? 1 : this.products.length / 3
      );
    },
    async searchData() {
      await this.$store.dispatch("products/getItemsByName", {text: this.keyword, category: this.category});
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
      this.text = this.keyword;
      this.searchMessage = "";
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
    },
    SetBook(product){
      this.$store.dispatch("Bookinfo/SetBook", product);
    }
  }
};
</script>
<style scoped lang="scss">
.text-color-info{
  font-family:Microsoft JhengHei;
  font-weight:bold;
}
.colcardbeatify{
    margin-bottom: 30px;
    box-shadow: 0px 3px 3px rgba(24, 22, 23, 0.5);
    border-radius: 20px;
    overflow: hidden;
    transition-duration: .3s;
    position: relative;
    bottom: 0px;

}

.colcardbeatify :hover{
        box-shadow: 0px 10px 30px rgba(124, 101, 112, 0.5);
        bottom: 10px;
}

</style>