import { GetProductsByCategory, GetBooksByCategory } from "../../api/home";
import { GetProductsByName } from "../../api/home";
/*import { GetProductsByTextBook } from "../../api/home";*/

const state = {
  items: []
};

const actions = {
  async getAllItems({ commit }, category) {
    const items = (await GetProductsByCategory(category)).data.data;
    items.forEach(item => {
      item.Inventory = parseInt(item.Inventory);
    });
    commit("setItems", items);
  },
  async getAllBooks({ commit }, category) {
    const items = (await GetBooksByCategory(category)).data.data;
    items.forEach(item => {
      item.Inventory = parseInt(item.Inventory);
    });
    commit("setItems", items);
  },
  async getItemsByName({ commit }, data) {
    try{
    const items = (await GetProductsByName(data.text, data.category)).data.data;
    items.forEach(item => {
      item.Inventory = parseInt(item.Inventory);
    });
    commit("setItems", items);
  }
  catch(exception){
    console.log("exeption");
    commit("setItems", null);
  }
}
};

const mutations = {
  setItems(state, items) {
    state.items = items;
  },
  decrementProductInventory(state, { ID }) {
    const item = state.items.find(item => item.id === ID);
    item.Inventory--;
  }
};

const getters = {
  Items() {
    return state.items;
  }
};

export default { namespaced: true, state, actions, mutations, getters };
