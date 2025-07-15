import moment from "moment";

export const useDebounce = function(func, delay = 300) {
    let timeoutId;

    return function(...args) {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => func.apply(this, args), delay);
    };
};

export const timestampToDate = function(timestamp) {
    return moment(timestamp).format("YYYY-MM-DD hh:mm:s");
};
