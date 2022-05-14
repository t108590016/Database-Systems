import Vue from "vue";
import VueRouter from "vue-router";
import Home from "@/views/Home.vue";
import Login from "@/views/Login.vue";
import Create from "@/views/Create.vue";
import ShoppingCart from "@/views/ShoppingCart.vue";
import OrderRecord from "@/views/OrderRecord.vue";
import ProcessOrder from "@/views/ProcessOrder.vue";
import MyProduct from "@/views/MyProduct.vue";
import NewProduct from "@/views/NewProduct.vue";
import AddBook from "@/views/NewBook.vue";
import Msn from "@/views/Msn.vue";
import MsnRecordMyself from "@/views/MsnRecordMyself.vue";
import MsnRecord from "@/views/MsnRecord.vue";
import BookInfo from "@/views/BookInfo.vue";
//import store from "@/store";

Vue.use(VueRouter);

/*const CheckIsSeller = next => {
  if (store.getters["login/Role"] === "seller") next();
  else next({ name: "Home" });
};*/

const routes = [
  {
    path: "/home",
    name: "Home",
    component: Home
  },
  {
    path: "/bookinfo",
    name: "BookInfo",
    component: BookInfo
  },
  {
    path: "/create",
    name: "Create",
    component: Create
  },
  {
    path: "/login",
    name: "Login",
    component: Login
  },
  {
    path: "/shoppingcart",
    name: "ShoppingCart",
    component: ShoppingCart
  },
  {
    path: "/orderrecord",
    name: "Order",
    component: OrderRecord
  },
  {
    path: "/processorder",
    name: "ProcessOrder",
    component: ProcessOrder,
  },
  {
    path: "/myproduct",
    name: "MyProduct",
    component: MyProduct,
  },
  {
    path: "/addBook",
    name: "AddBook",
    component: AddBook,
  },
  {
    path: "/newproduct",
    name: "NewProduct",
    component: NewProduct,
  },
  {
    path: "/msn",
    name: "Msn",
    component: Msn,
  },
  {
    path: "/msnrecordmyself",
    name: "MsnRecordMyself",
    component: MsnRecordMyself,
  },
  {
    path: "/msnrecord",
    name: "MsnRecord",
    component: MsnRecord,
  },
  {
    path: "*",
    name: "NotFound",
    redirect: { name: "Home" }
  },
  {
    path: "/",
    name: "root",
    redirect: { name: "Home" }
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    // component: () =>
    //   import(/* webpackChunkName: "about" */ "../views/About.vue")
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

export default router;
