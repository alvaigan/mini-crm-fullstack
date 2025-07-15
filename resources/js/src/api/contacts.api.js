import { get, post } from "../utils/axios";

export default {
    getContacts(params, cb) {
        get("/contacts", params).then((res) => {
            if (res.data) {
                cb(res.data);
            }
        });
    },

    getCallLogs(params, cb) {
        get("/call-logs", params).then((res) => {
            if (res.data) {
                cb(res.data);
            }
        });
    },

    createCallLog(body, cb) {
        post("/call-logs", body).then((res) => {
            if (res.data) {
                cb(res.data);
            }
        });
    },

    toggleFavorite(id, cb) {
        post(`/contacts/${id}/toggle-favorite`).then((res) => {
            if (res.data) {
                cb(res.data);
            }
        });
    },
};
