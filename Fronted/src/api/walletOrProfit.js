import axios from "axios";


export const Deposit = async amount => {
  const formData = new FormData();
  formData.append("request", "deposit");
  formData.append("amount", amount);
  //print(amount);
  console.log("amount");
  console.log(amount);
  const res = await axios.post("/php/login.php", formData);
  return res;
};

