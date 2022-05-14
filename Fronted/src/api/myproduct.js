import axios from "axios";

export const Getmyproduct = async userno => {
  const formData = new FormData();
  formData.append("request", "getmyproduct");
  formData.append("userno", userno);
  try {
    const response = await axios.post("/php/myproduct.php", formData);
    return response.data;
  } catch (err) {
    console.log(err);
  }
};

export const GetSellingBook = async ISBN => {
  const formData = new FormData();
  formData.append("request", "getsellingbook");
  formData.append("ISBN", ISBN);
  try {
    const response = await axios.post("/php/myproduct.php", formData);
    return response.data;
  } catch (err) {
    console.log(err);
  }
};

export const OffProduct = async (userID, productISBN) => {
  const formData = new FormData();
  formData.append("request", "offproduct");
  formData.append("userID", userID);
  formData.append("productISBN", productISBN);
  try {
    const response = await axios.post("/php/myproduct.php", formData);
    return response.data;
  } catch (err) {
    console.log(err);
  }
};

export const LaunchProduct = async productId => {
  const formData = new FormData();
  formData.append("request", "launchproduct");
  formData.append("productID", productId);
  try {
    const response = await axios.post("/php/myproduct.php", formData);
    return response.data;
  } catch (err) {
    console.log(err);
  }
};

export const UploadFile = async fileObj => {
  const formData = new FormData();
  formData.append("image", fileObj);
  try {
    const response = await axios.post("/php/uploadFile.php", formData);
    return response.data;
  } catch (err) {
    console.log(err);
  }
};

export const PublishProduct = async (ISBN, userId, price) => {
  const formData = new FormData();
  formData.append("request", "publish");
  formData.append("ISBN", ISBN);
  formData.append("price", price);
  formData.append("userId", userId);
  try {
    const response = await axios.post("/php/publish.php", formData);
    return response.data;
  } catch (err) {
    console.log(err);
  }
}; 

export const PublishBook = async Book => {
  const formData = new FormData();
  formData.append("request", "publishBook");
  formData.append("ISBN", Book.ISBN);
  formData.append("name", Book.name);
  formData.append("category", Book.category);
  formData.append("description", Book.description);
  formData.append("imageLink", Book.imageLink);
  try {
    const response = await axios.post("/php/publish.php", formData);
    return response.data;
  } catch (err) {
    console.log(err);
  }
}; 

export const Replenishment = async (product, inventory) => {
  const formData = new FormData();
  formData.append("request", "replenishment");
  formData.append("productID", product.id);
  formData.append("inventory", inventory);
  try {
    const response = await axios.post("/php/myproduct.php", formData);
    return response.data;
  } catch (err) {
    console.log(err);
  }
};
 