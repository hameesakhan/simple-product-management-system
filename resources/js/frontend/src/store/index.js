import { createStore } from "vuex";

import { SET_CATEGORIES, SET_ACTIVE_CATEGORY, ADD_CATEGORY, CHANGE_CATEGORY, REMOVE_CATEGORY } from './category'
import { fetchCategories, fetchCategory, createCategory, updateCategory, deleteCategory } from './category'

import { SET_VENDORS, SET_ACTIVE_VENDOR, ADD_VENDOR, CHANGE_VENDOR, REMOVE_VENDOR } from './vendor'
import { fetchVendors, fetchVendor, createVendor, updateVendor, deleteVendor } from './vendor'

import { SET_PRODUCTS, SET_ACTIVE_PRODUCT, ADD_PRODUCT, CHANGE_PRODUCT, REMOVE_PRODUCT } from './product'
import { fetchProducts, fetchProduct, createProduct, updateProduct, deleteProduct } from './product'

export default createStore({
  state: {
    hideConfigButton: false,
    isPinned: true,
    showConfig: false,
    sidebarType: "bg-gradient-dark",
    isRTL: false,
    color: "success",
    isNavFixed: false,
    isAbsolute: false,
    showNavs: true,
    showSidenav: true,
    showNavbar: true,
    showFooter: true,
    showMain: true,
    isDarkMode: false,
    navbarFixed:
      "position-sticky blur shadow-blur left-auto top-1 z-index-sticky px-0 mx-4",
    absolute: "position-absolute px-4 mx-0 w-100 z-index-2",
  },
  mutations: {
    toggleConfigurator(state) {
      state.showConfig = !state.showConfig;
    },
    navbarMinimize(state) {
      const sidenav_show = document.querySelector(".g-sidenav-show");

      if (sidenav_show.classList.contains("g-sidenav-pinned")) {
        sidenav_show.classList.remove("g-sidenav-pinned");
        state.isPinned = true;
      } else {
        sidenav_show.classList.add("g-sidenav-pinned");
        state.isPinned = false;
      }
    },
    navbarFixed(state) {
      if (state.isNavFixed === false) {
        state.isNavFixed = true;
      } else {
        state.isNavFixed = false;
      }
    },
    toggleEveryDisplay(state) {
      state.showNavbar = !state.showNavbar;
      state.showSidenav = !state.showSidenav;
      state.showFooter = !state.showFooter;
    },
    toggleHideConfig(state) {
      state.hideConfigButton = !state.hideConfigButton;
    },
    color(state, payload) {
      state.color = payload;
    },

    // Categories
    SET_CATEGORIES, SET_ACTIVE_CATEGORY, ADD_CATEGORY, CHANGE_CATEGORY, REMOVE_CATEGORY,

    // Vendors
    SET_VENDORS, SET_ACTIVE_VENDOR, ADD_VENDOR, CHANGE_VENDOR, REMOVE_VENDOR,

    // Products
    SET_PRODUCTS, SET_ACTIVE_PRODUCT, ADD_PRODUCT, CHANGE_PRODUCT, REMOVE_PRODUCT,
  },
  actions: {
    setColor({ commit }, payload) {
      commit("color", payload);
    },

    // Categories
    fetchCategories, fetchCategory, createCategory, updateCategory, deleteCategory,

    // Vendors
    fetchVendors, fetchVendor, createVendor, updateVendor, deleteVendor,

    // Products
    fetchProducts, fetchProduct, createProduct, updateProduct, deleteProduct,
  },
  getters: {},
});
