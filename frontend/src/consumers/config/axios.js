import axios from "axios";

axios.create({
  headers: {
    "Access-Control-Allow-Origin": "*",
    "Access-Control-Allow-Methods": "*",
    "Access-Control-Allow-Credentials": true,
    "Content-Type": "application/json",
  },
  https: false,
  withCredentials: false,
});

export default axios;
