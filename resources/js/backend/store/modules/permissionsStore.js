import axios from "axios";
const permissionsApi = "/panel/api/permissions/"

const state = {
     permissions: [],
};
const getters = {
     getPermissions: state => state.permissions,
     getPermission: (state) => (roleId) => state.permissions.find((role) => role.id == roleId)
};
const actions = {
     loadPermissions({ commit }) {
          axios
               .get(permissionsApi)
               .then(response => response.data.data)
               .then(permissions => {
                    console.log('permissions', permissions);
                    commit("LOAD_PERMISSIONS", permissions);
               });
     },

};
const mutations = {
     LOAD_PERMISSIONS(state, permissions) {
          state.permissions = permissions
     },
};

export default {
     namespaced: true,
     state,
     getters,
     actions,
     mutations
};
