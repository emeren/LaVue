import axios from "axios";
const rolesApi = "/panel/api/roles/"

const state = {
     roles: [],
};

const getters = {
     getRoles: state => state.roles,
     getRole: (state) => (id) => state.roles.find((role) => role.id == id)
};

const actions = {
     loadRoles({ commit }) {
          axios
               .get(rolesApi)
               .then(response => response.data.data)
               .then(roles => {
                    commit("LOAD_ROLES", roles);
               });
     },
     createRole({ commit }, roleData) {
          axios.post(rolesApi, roleData).then(role => {
               commit("CREATE_ROLE", role.data);
          });
     },
     updateRole({ commit }, roleData) {
          axios.put(rolesApi + roleData.id, roleData).then(role => {
               console.log('role', role);
               commit("UPDATE_ROLE", role.data);
          });
     }
};

const mutations = {
     LOAD_ROLES(state, roles) {
          console.log('roles', roles);
          state.roles = roles
     },
     CREATE_ROLE(state, createdroleData) {
          let index = state.roles.findIndex((role) => role.id == createdroleData.id);
          state.roles.push(index, 1, createdroleData);
     },
     UPDATE_ROLE(state, updatedroledata) {
          let index = state.roles.findIndex((role) => role.id == updatedroledata.id);
          state.roles.splice(index, 1, updatedroledata);
     }

};

export default {
     namespaced: true,
     state,
     getters,
     actions,
     mutations
};
