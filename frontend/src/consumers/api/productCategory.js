import axios from "../config/axios";
import { API_BASE_URL } from "../config/constants";

/**
 *
 * @param {Function} callback
 * @param {String} url Api url address
 * @returns
 */
export function listProductCategory(callback, uri = "/product-category/list") {
  return axios
    .get(API_BASE_URL + uri)
    .then(({ data }) => callback && callback(data))
    .catch((error) => console.log(error));
}

/**
 *
 * @param {Function} callback
 * @param {String} url Api url address
 * @returns
 */
export function createProductCategory(data, callback, uri = "/product-category/create") {
  return axios
    .post(API_BASE_URL + uri, data)
    .then(({ data }) => callback && callback(data))
    .catch((error) => console.log(error));
}
