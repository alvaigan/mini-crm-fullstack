import contactsApi from "../api/contacts.api";

const state = () => ({
    contacts: [],
    callLogs: [],
});

const getters = {};

const actions = {
    getAllContacts({ commit, state }, params) {
        contactsApi.getContacts(params, (data) => {
            commit("setContacts", data.data);
        });
    },

    getAllCallLogs({ commit, state }, params) {
        contactsApi.getCallLogs(params, (data) => {
            commit("setCallLogs", data.data);
        });
    },

    createCallLog({ commit, state }, body) {
        contactsApi.createCallLog(body, (data) => {
            console.log(data);
        });
    },

    toggleFavorite({ commit, state }, id) {
        contactsApi.toggleFavorite(id, (data) => {
            console.log(data);
        });
    },
};

const mutations = {
    setContacts(state, contacts) {
        state.contacts = contacts;
    },
    setCallLogs(state, callLogs) {
        state.callLogs = callLogs;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
