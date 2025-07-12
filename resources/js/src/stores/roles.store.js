import rolesApi from "../api/roles.api";

const state = () => ({
    roles: [],
});

const getters = {};

const actions = {
    getAllRoles({ commit, state }) {
        rolesApi.getRoles((data) => {
            commit("setRoles", data.data);
        });
    },
};

const mutations = {
    setRoles(state, roles) {
        state.roles = roles;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
