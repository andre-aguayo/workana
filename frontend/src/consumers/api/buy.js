import axios from "../config/axios";
import { API_BASE_URL } from "../config/constants";

/**
 *
 * @param {Function} callback
 * @param {String} url Api url address
 * @returns
 */
export function buyProducts(data, callback, uri = "sale/create") {
  console.log(data);
  return axios
    .post(API_BASE_URL + uri, data)
    .then(({ data }) => callback && callback(data))
    .catch((error) => console.log(error));
}
