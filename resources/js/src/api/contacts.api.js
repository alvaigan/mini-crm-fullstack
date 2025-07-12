import { get } from "../utils/axios";

export default {
    getContacts(params, cb) {
        get("/contacts", params).then((res) => {
            if (res.data) {
                cb(res.data);
            }
        });
    },
};
