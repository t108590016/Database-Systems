<template>
  <v-main class="mb-10">
    <v-app-bar app flat color=#141124>
      <v-spacer></v-spacer>
      <div><b-dropdown text="Block Level Dropdown" block variant="primary" class="m-2">
      <b-form-select v-model="selected" :options="options">
      <router-link
        v-if="isLogin && IsSeller"
        to="/addBook"
        class="my-router-link pa-1"
      >
      
      <b-form-select-option class="menu-color-one" value="a">AddBook</b-form-select-option>
      </router-link>


<div class="dropdown" v-if="isLogin">
  <button class="dropbtn">Message</button>
  <div class="dropdown-content">
      <router-link
        v-if="isLogin"
        to="/msn"
        class="my-router-link pa-1"
      >
        <b-form-select-option class="menu-color-four" value="b">SentMsn</b-form-select-option>
      </router-link>
      <router-link
        v-if="isLogin"
        to="/msnrecord"
        class="my-router-link pa-1"
      >
<b-form-select-option class="menu-color-four" value="c">MsnRecord</b-form-select-option>
      </router-link>
      
      <router-link
        v-if="isLogin"
        to="/msnrecordmyself"
        class="my-router-link pa-1"
      >

        <b-form-select-option class="menu-color-four" value="d">SentRecord</b-form-select-option>
      </router-link>
       </div>
</div>

      <router-link
        v-if="isLogin"
        to="/myproduct"
        class="my-router-link pa-1"
      >
        <b-form-select-option class="menu-color-one" value="e">MyProduct</b-form-select-option>
      </router-link>
      
      <router-link
        v-if="isLogin"
        to="/newproduct"
        class="my-router-link pa-1"
      >
       <b-form-select-option class="menu-color-two" value="f">AddProduct</b-form-select-option>
      </router-link>
      
      <router-link
        v-if="isLogin"
        class="my-router-link"
        to="/orderrecord"
      >
        <b-form-select-option class="menu-color-one" value="g">
          MyOrder
       </b-form-select-option>
      </router-link>
      
      <router-link
        v-if="isLogin"
        class="my-router-link"
        to="/processorder"
      >
        <b-form-select-option class="menu-color-two" value="h">
          ProcessOrder
        </b-form-select-option>
      </router-link>
      
      <router-link
        v-if="isLogin"
        class="my-router-link pa-1"
        to="/shoppingcart"
      >
        <v-badge
          v-if="true"
          :content="CartItemLength"
          :value="CartItemLength"
          overlap
        >
          <b-form-select-option class="menu-color-one" value="i">
            <v-icon color="#FFF">mdi-cart-arrow-down</v-icon>
          </b-form-select-option>
        </v-badge>
      </router-link>
      </b-form-select></b-dropdown></div>
      <div class="pa-1 d-flex flex-row">
        <router-link v-if="!isLogin" class="my-router-link1" to="/create">
          <v-btn class="nav3" block>
           <span class="menu-color-three">Create</span> 
          </v-btn>
        </router-link>

        <router-link v-if="!isLogin" class="my-router-link1" to="/login">
          <v-btn color="#f9d600" class="nav2" block>
           <span class="menu-color-three">Login</span> 
          </v-btn>
        </router-link>
        <v-btn color="#f9d600" class="nav2" v-if="isLogin" block @click="logout">
         <span class="menu-color-three">Logout</span> 
        </v-btn>
      </div>
    </v-app-bar>
    <v-navigation-drawer permanent floating app color=#141124>
      <a href="/home">
        <img id="logo" src="@/img/logo.png" alt="logo" />
      </a>
      <v-list>
        <router-link class="my-router-link" to="/home?category=all" >
          <v-list-item link>
            <v-list-item-content class="nav">
              <v-list-item-title class="leftTextColor">ALL</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </router-link>
        <router-link
          v-for="(category, i) in categories"
          :key="i"
          class="my-router-link"
          :to="getUrl(category)"
        >
          <v-list-item class="nav" link>
            <v-list-item-content>
              <v-list-item-title class="leftTextColor">{{ titleCase(category) }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </router-link>
      </v-list>
    </v-navigation-drawer>

    <router-view />
  </v-main>
</template>

<script>
import { mapGetters } from "vuex";
import { GetProductsCategories } from "@/api/home";
export default {
  data() {
    return {
      categories: [],
      selected: null,
        options: [
          { value: 'a', text: 'A' },
          { value: 'b', text: 'B' },
          { value: 'c', text: 'C' },
          { value: 'd', text: 'D' },
          { value: 'e', text: 'E' },
          { value: 'f', text: 'F' },
          { value: 'g', text: 'G' },
          { value: 'h', text: 'H' },
          { value: 'i', text: 'I' }

        ]
    };
  },
  computed: {
    ...mapGetters({ isLogin: "login/IsLogin" }),
    ...mapGetters({ CartItemLength: "shoppingCart/CartItemLength" }),
    ...mapGetters({ IsSeller: "login/IsSeller" }),
    ...mapGetters({ moneyInfo: "wallet/GetWallet" }),
    getUrl: () =>
      function(category) {
        return `/home?category=${category}`;
      }
  },
  async created() {
    //await this.$store.dispatch("wallet/init");
    this.categories = (await GetProductsCategories()).categories;
  },
  methods: {
logout() {
      this.$store.dispatch("login/logout");
      this.$store.dispatch("shoppingCart/logout");
      this.$router.push("/home").catch(err => {
        err;
      });
    },
    titleCase(str) {
      const newStr = str.slice(0, 1).toUpperCase() + str.slice(1).toLowerCase();
      return newStr;
    }
  }
};
</script>

<style>


#logo {
  width: 250px;
}

.my-router-link {
  text-decoration: none !important;

}
.my-router-link1 {
  text-decoration: none !important;

}



.my-router-link :hover{
  text-decoration: none !important;
  font-size: 21px;
  color: #12b8b8;

}
.menu-color-one{

  color: #f0ffff;
  font-size: 20px;
  font-family:Microsoft JhengHei;
  font-weight:bold;
}


.menu-color-one :hover{

  color: #f9d600;
  font-size: 20px;

}

.menu-color-two{

  color: #f9d600;
  font-size: 20px;
  font-family:Microsoft JhengHei;
  font-weight:bold;
}

.menu-color-two :hover{

  color: #e6e4dd;
  font-size: 20px;
}


.menu-color-four{

  color: #f9d600;
  font-size: 20px;
  font-family:Microsoft JhengHei;
  font-weight:bold;
}

.menu-color-four :hover{

  color: #e6e4dd;
  font-size: 20px;
}

.moneyInfo {
  text-decoration: none !important;
  color: #202020 !important;
}

.leftTextColor {
  color: white ;
}
.nav :hover{
  color: #f9d600;
  text-transform:uppercase;
  font-size: 22px;
  font-family:Microsoft JhengHei;
  font-weight:bold;
}
.nav {
  color: rgb(246, 247, 239) ;
  text-transform:uppercase;
  font-size: 18px;
  font-family:Microsoft JhengHei;
  font-weight:bold;
}
.nav2 :hover{
  color: #f0ffff;
  font-size: 16px;
  font-family:Microsoft JhengHei;
  font-weight:bold;

}
.nav2 {
  font-size: 16px;
  font-family:Microsoft JhengHei;
  font-weight:bold;

}
.nav3 :hover{
  color: #164685;
  font-size: 16px;
  font-family:Microsoft JhengHei;
  font-weight:bold;

}
.nav3 {
  font-size: 16px;
  font-family:Microsoft JhengHei;
  font-weight:bold;

}

/* Dropdown Button */
.dropbtn {
  background-color: #141124;
  color: #f9d600;
  padding: 16px;
  font-size: 20px;
  font-family:Microsoft JhengHei;
  font-weight:bold;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #141124;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {background-color: #141124;}


</style>
