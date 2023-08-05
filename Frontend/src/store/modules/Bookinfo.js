const getDefaultState = () => {
  return localStorage.getItem("bookInfo")
    ? { items: JSON.parse(localStorage.getItem("bookInfo")) }
    : {
      items: {
        ISBN: "",
        Name: "",
        Description: "",
        ImageURL: ""
      }
      };
};

const state = getDefaultState();

const actions = {
  setISBN({ commit }, ISBN) {
    commit("setISBN", ISBN);
  },
  setName({ commit }, Name) {
    commit("setName", Name);
  },
  setDescription({ commit }, Description) {
    commit("setDescription", Description);
  },
  setImageURL({ commit }, ImageURL) {
    commit("setImageURL", ImageURL);
  },
  async SetBook({ commit }, book) {
    commit("setISBN", book.ISBN);
    commit("setName", book.Name);
    commit("setDescription", book.Description);
    commit("setImageURL", book.ImageURL);
    localStorage.setItem("bookInfo", JSON.stringify(state.items));
  }
};

const mutations = {
  setISBN(state, ISBN) {
    state.items.ISBN = ISBN;
  },
  setName(state, Name) {
    state.items.Name = Name;
  },
  setDescription(state, Description) {
    state.items.Description = Description;
  },
  setImageURL(state, ImageURL) {
    state.items.ImageURL = ImageURL;
  },
  setItems(state, items) {
    state.items = items;
  }
};
const getters = {
  Items() {
    return state.items;
  }
};

export default { namespaced: true, state, actions, mutations, getters };
