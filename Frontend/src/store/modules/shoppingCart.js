import { Checkout } from "@/api/shoopingCart";
//import { UpdateWallet } from "@/api/walletOrProfit";

const getDefaultState = () => {
  const cart = localStorage.getItem("cart")
    ? JSON.parse(localStorage.getItem("cart"))
    : { items: []};
  return {
    // item: [{ id, quantity }]
    items: cart.items,
    checkoutStatus: null,
    errorMessage: ""
  };
};

const state = getDefaultState();

const actions = {
  resetCartState({ commit }) {
    commit("resetCartState");
  },
  addProductToCart({ state, commit }, product) {
    commit("setCheckoutStatus", null);
      const cartItem = state.items.find(item => item.ISBN === product.ISBN && item.sellerID === product.sellerID);
      if (!cartItem) {
        commit("pushProductToCart", {
          ISBN: product.ISBN,
          Name: product.Name,
          sellerID: product.sellerID,
          imageUrl: product.ImageURL,
          price: product.price
        });
      } else {
        commit("incrementItemQuantity", cartItem);
      }
  },
  async Checkout({ state, commit }, userId) {
    Checkout(state.items, userId).then(() => {
      commit("CleanShoopingCart");
      commit("resetCartState");
    });
  },
  logout({ commit /*, dispatch*/ }) {
    localStorage.removeItem("user");
   
    commit("CleanShoopingCart");
    commit("resetCartState")
}
};

const mutations = {
  resetCartState(state) {
    Object.assign(state, getDefaultState());
  },
  setCheckoutStatus(state, status) {
    state.checkoutStatus = status;
  },
  pushProductToCart(state, { ISBN, Name, sellerID, imageUrl, price }) {
    state.items.push({
      ISBN,
      Name,
      sellerID,
      imageUrl,
      price,
      quantity: 1
    });
    localStorage.setItem("cart", JSON.stringify(state));
    console.log(state.items);
  },
  remoItemFromShoopingCart(state, { ISBN, sellerID }) {
    const cartItem = state.items.find(item => item.ISBN === ISBN && item.sellerID === sellerID);
    state.items.splice(state.items.indexOf(cartItem), 1);
    localStorage.setItem("cart", JSON.stringify(state));
  },
  CleanShoopingCart(state) {
    state.items.length = 0;
    localStorage.setItem("cart", JSON.stringify(state));
  }
};

const getters = {
  CartItems: (state, getters, rootState) => {
    if (rootState.products.items.length <= 0) return [];
    return state.items.map(({ ISBN, sellerID }) => {
      const product = rootState.products.items.find(item => item.ISBN === ISBN && item.sellerID === sellerID);
      if (product){
        return {
          ISBN: product.ISBN,
          sellerID: product.sellerID,
          title: product.Name,
          price: product.price,
          imageUrl: product.ImageURL,
          quantity: 1
        };}
    });
  },
  CartTotalPrice: (state, getters) => {
    if (getters.CartItems.length === 0) return 0;
    return (
      getters.CartItems.reduce((total, item) => {
        return total + item.price * item.quantity;
      }, 0)
    );
  },
  GetItemSubTotal: () => item => {
    return item.price * item.quantity;
  },
  CartItemLength: state => {
    return state.items.reduce((total, item) => {
      return total + item.quantity;
    }, 0);
  },
  ErrorMessage: state => state.errorMessage
};

export default { namespaced: true, state, actions, mutations, getters };
