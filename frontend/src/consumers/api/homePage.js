import axios from "../config/axios";
import { API_BASE_URL } from "../config/constants";

/**
 *
 * @param {Function} callback
 * @param {String} url Api url address
 * @returns
 */
export function productCategoriesWithProducts(callback, uri = "") {
  return axios
    .get(API_BASE_URL + uri)
    .then(({ data }) => callback && callback(data))
    .catch((error) => console.log(error));
}
