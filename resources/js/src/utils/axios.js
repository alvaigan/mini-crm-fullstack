import axios from "axios";
import queryString from "query-string";

const instance = axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL ?? "hehe",
});

instance.interceptors.response.use(async (res) => {
    return res;
});

export function get(url, params) {
    let fullUrl = url;

    if (params) {
        const queryParams = queryString.stringify(params);
        fullUrl += `?${queryParams}`;
    }

    return instance.get(fullUrl, params);
}

export function post(url, data) {
    return instance.get(url, data);
}

export function destroy(url) {
    return instance.get(url);
}
