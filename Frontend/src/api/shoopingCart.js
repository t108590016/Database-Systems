import store from "@/store";
import axios from "axios";

export const Checkout = async (productIds, userId) => {
  const totalPrice = store.getters["shoppingCart/CartTotalPrice"];
  const formData = new FormData();
  formData.append("request", "purchaseshoppingcart");
  formData.append("userno", userId);
  formData.append("total", totalPrice);
  formData.append("productIDs", JSON.stringify(productIds));
  try {
    const response = await axios.post("/php/shoppingCart.php", formData);
    return response;
  } catch (err) {
    console.log(err);
  }
};
