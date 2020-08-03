import axios from "axios";

const categoriesApi = "/panel/api/categories/"

const state = {
     allCategories: [],
     singleCategory: {},
     editCategory: false,
     flatCategories: []
};

const getters = {
     getCategories: state => state.allCategories,

     flatCategories: state => {
          let objectInfoArray = [];
          function returnChildren(array) {
               array.forEach((object) => {
                    const objectInfo = { catId: object.id, parent: object.parent_id }
                    objectInfoArray.push(objectInfo);
                    if (array.children && array.children.length > 0) return
                    returnChildren(object.children)
               })
               return objectInfoArray;
          }
     },


     getUniqeCats: state => {
          const flatten = (obj) => {
               const array = Array.isArray(obj) ? obj : [obj];
               return array.reduce((acc, value) => {
                    acc.push(value);
                    if (value.children) {
                         acc = acc.concat(flatten(value.children));
                         delete value.children;
                    }
                    return acc;
               }, []);
          }
          return flatten(state.allCategories);
     },
     singleCategory: state => state.singleCategory,
     editing: state => state.editCategory

};

const actions = {
     loadCategories: ({ commit }) => {
          axios.get(categoriesApi)
               .then(response => response.data.data)
               .then(categories => {

                    commit("LOAD_CATEGORIES", categories);

               });
     },
     updateCategories: ({ commit }, categories) => {
          commit("UPDATE_CATEGORIES", categories);
     },

     updateCategory: ({ dispatch, commit }, category) => {
          console.log('category 12:', category);
          axios
               .put(categoriesApi + category.id, category)
               .then(categories => {
                    dispatch('loadCategories');
               });
     },

     createCategory: ({ dispatch, commit }, category) => {
          axios
               .post(categoriesApi, category)
               .then(categories => {
                    dispatch('loadCategories');
               });
     },

     deleteCategory: ({ dispatch, commit }, catId) => {
          axios.delete(categoriesApi + catId).then(cat => {
               dispatch('loadCategories');
          });
     },

     editCategory: ({ commit }, category = {}) => {

          commit("EDIT_CATEGORY", category);
     },
     setParentChild: ({ dispatch }, parentChild) => {
          console.log('parentChild :', parentChild);
     },
};
const mutations = {

     EDIT_CATEGORY: (state, category) => {
          state.singleCategory = category
          category.id ? state.editCategory = true : state.editCategory = false
     },
     UPDATE_CATEGORY: (state, updatedCategoryData) => {

          let newArr = [...state.allCategories]
          console.log('newArr :', newArr);
     },
     UPDATE_CATEGORIES: (state, categories) => {
          state.allCategories = categories;
     },
     LOAD_CATEGORIES: (state, categories) => {
          state.allCategories = categories
     }
};


export default {
     namespaced: true,
     state,
     getters,
     actions,
     mutations
};
