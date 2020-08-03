import Vuex from "vuex";
import VueRouter from "vue-router";
import { shallowMount, createLocalVue } from "@vue/test-utils";

import Dashboard from "../../../resources/js/backend/Dashboard.vue";
//CHILDRENS
import Navbar from "../../../resources/js/backend/layout/Navbar.vue";
import Aside from "../../../resources/js/backend/layout/Aside.vue";
import Content from "../../../resources/js/backend/layout/Content.vue";
import Footer from "../../../resources/js/backend/layout/Footer.vue";

import Notifications from "vue-notification";

import expect from "expect";

const localVue = createLocalVue();
localVue.use(Vuex);
localVue.use(VueRouter);
localVue.component("Notifications", Notifications);
const router = new VueRouter();
describe.only("Dashboard", () => {
    let wrapper;
    let getters;
    let store;
    beforeEach(() => {
        getters = {
            asideCollapse: () => false,
        };

        store = new Vuex.Store({
            modules: {
                dashboard: {
                    namespaced: true,
                    getters,
                },
            },
        });
        wrapper = shallowMount(Dashboard, {
            store,
            localVue,
        });
    });

    //Dashboard elements

    it("Compontent NavBar", () => {
        expect(wrapper.find(Navbar).exists()).toBe(true);
    });

    it("Compontent Aside", () => {
        expect(wrapper.find(Aside).exists()).toBe(true);
    });

    it("Compontent Content", () => {
        expect(wrapper.find(Content).exists()).toBe(true);
    });
    it("Compontent Content", () => {
        //TODO click treiger
        // wrapper.find(".navbar-nav").trigger("click")
        // expect(wrapper.classes("sidebar-collapse")).toBe(true);
    });
});
