import Vuex from "vuex";
import VueRouter from "vue-router";
import { shallowMount, createLocalVue } from "@vue/test-utils";
import Desktop from "../../../resources/js/backend/pages/Desktop.vue";
import ContentHeader from "../../../resources/js/backend/layout/partials/ContentHeader.vue";
import InfoBox from "../../../resources/js/backend/components/InfoBox.vue";
import LatestPost from "../../../resources/js/backend/components/LatestPosts.vue";
import expect from "expect";

const localVue = createLocalVue();
localVue.use(Vuex);
localVue.use(VueRouter);

const router = new VueRouter();
describe.only("Desktop", () => {
    let wrapper;
    let getters;
    let store;
    beforeEach(() => {
        getters = {
            postsCount: () => 5,
            filteredPosts: () => {
                [{ title: "test", id: 1, description: "description" }];
            },
        };

        store = new Vuex.Store({
            modules: {
                posts: {
                    namespaced: true,
                    getters,
                },
            },
        });
        wrapper = shallowMount(Desktop, {
            store,
            localVue,
        });
    });

    //Dashboard elements

    it("Compontent ContentHeader loaded, Page has title", () => {
        expect(wrapper.find(ContentHeader).exists()).toBe(true);
        expect(wrapper.html()).toContain("Desktop");
    });

    it("Compontent InfoBox", () => {
        expect(wrapper.find(InfoBox).exists()).toBe(true);
    });

    it("Compontent LatestPosts", () => {
        expect(wrapper.find(LatestPost).exists()).toBe(true);
    });
});
