import axios from "../config/axios";
import { API_BASE_URL } from "../config/constants";

/**
 *
 * @param {Function} callback
 * @param {String} url Api url address
 * @returns
 */
export function createProduct(data, callback, uri = "/product/create") {
  return axios
    .post(API_BASE_URL + uri, data)
    .then(({ data }) => callback && callback(data))
    .catch((error) => console.log(error));
}
