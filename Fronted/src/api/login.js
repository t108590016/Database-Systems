import axios from "axios";

export const Create = async information => {
  console.log("Create");
  console.log("studentNum" + information.studentNum);
  const formData = new FormData();
  formData.append("studentNum", information.studentNum);
  formData.append("password", information.password);
  formData.append("checkPassword", information.checkPassword);
  formData.append("name", information.name);
  formData.append("phoneNum", information.phoneNum);
  formData.append("department", information.department);
  formData.append("request", "create");
  try {
    const response = await axios.post("/php/login.php", formData);
    return response;
  } catch (err) {
    console.log(err);
  }
};


export const Login = async function(email, password) {
  const formData = new FormData();
  formData.append("email", email);
  formData.append("password", password);
  formData.append("request", "login");
  try {
    const response = await axios.post("/php/login.php", formData);
    return response;
  } catch (err) {
    console.log(err);
  }
};

export const GetUserId = async () => {
  const formData = new FormData();
  formData.append("request", "getuserno");
  try {
    const response = await axios.post("/php/login.php", formData);
    return response;
  } catch (err) {
    console.log(err);
  }
};

export const Logout = async () => {
  const formData = new FormData();
  formData.append("request", "logout");
  try {
    const response = await axios.post("/php/login.php", formData);
    return response;
  } catch (err) {
    console.log(err);
  }
};
