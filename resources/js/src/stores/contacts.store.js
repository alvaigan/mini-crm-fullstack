import contactsApi from "../api/contacts.api";

const state = () => ({
    contacts: [],
});

const getters = {};

const actions = {
    getAllContacts({ commit, state }, params) {
        contactsApi.getContacts(params, (data) => {
            commit("setContacts", data.data);
        });
    },
};

const mutations = {
    setContacts(state, contacts) {
        state.contacts = contacts;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
