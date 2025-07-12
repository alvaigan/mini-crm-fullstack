import { get } from "../utils/axios";

export default {
    getRoles(cb) {
        get("/roles").then((res) => {
            if (res.data) {
                cb(res.data);
            }
        });
    },
};
