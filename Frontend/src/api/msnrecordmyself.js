import axios from "axios";

export const Getmymsn= async UserId => {
  const formData = new FormData();
  formData.append("request", "getmymsn");
  formData.append("userno", UserId);
  try {
    const response = await axios.post("/php/mymsn.php", formData);
    return response.data;
  } catch (err) {
    console.log(err);
  }
};

export const Getmsn= async UserId => {
  const formData = new FormData();
  formData.append("request", "getmsn");
  formData.append("userno", UserId);
  try {
    const response = await axios.post("/php/mymsn.php", formData);
    return response.data;
  } catch (err) {
    console.log(err);
  }
};

export const PublishProduct = async msn => {
  const formData = new FormData();
  formData.append("request", "recordmyself");
  formData.append("reciever", msn.reciever);
  formData.append("sender", msn.sender);
  formData.append("topic", msn.topic);
  formData.append("content", msn.content);
  try {
    const response = await axios.post("/php/recordmyself.php", formData);
    return response.data;
  } catch (err) {
    console.log(err);
  }
}; 