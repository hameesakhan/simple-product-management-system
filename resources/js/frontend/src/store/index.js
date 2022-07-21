import { createStore } from "vuex";

import { SET_CATEGORIES, SET_ACTIVE_CATEGORY, ADD_CATEGORY, CHANGE_CATEGORY, REMOVE_CATEGORY } from './category'
import { fetchCategories, fetchCategory, createCategory, updateCategory, deleteCategory } from './category'

import { SET_VENDORS, SET_ACTIVE_VENDOR, ADD_VENDOR, CHANGE_VENDOR, REMOVE_VENDOR } from './vendor'
import { fetchVendors, fetchVendor, createVendor, updateVendor, deleteVendor } from './vendor'

import { SET_PRODUCTS, SET_PRODUCTS_PAGINATION, SET_ACTIVE_PRODUCT, ADD_PRODUCT, CHANGE_PRODUCT, REMOVE_PRODUCT } from './product'
import { fetchProducts, fetchProduct, createProduct, updateProduct, deleteProduct } from './product'

import { SET_TRANSACTIONS, SET_TRANSACTIONS_PAGINATION, SET_ACTIVE_TRANSACTION, ADD_TRANSACTION, CHANGE_TRANSACTION, REMOVE_TRANSACTION } from './transaction'
import { fetchTransactions, fetchTransaction, createTransaction, updateTransaction, deleteTransaction } from './transaction'

import { SET_USERS, SET_ACTIVE_USER, ADD_USER, CHANGE_USER, REMOVE_USER } from './user'
import { fetchUsers, fetchUser, createUser, updateUser, deleteUser } from './user'

import { SET_ROLES, SET_ACTIVE_ROLE, ADD_ROLE, CHANGE_ROLE, REMOVE_ROLE } from './role'
import { fetchRoles, fetchRole, createRole, updateRole, deleteRole } from './role'

import { SET_PERMISSIONS, SET_ACTIVE_PERMISSION, ADD_PERMISSION, CHANGE_PERMISSION, REMOVE_PERMISSION } from './permission'
import { fetchPermissions, fetchPermission, createPermission, updatePermission, deletePermission } from './permission'

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
    SET_PRODUCTS, SET_PRODUCTS_PAGINATION, SET_ACTIVE_PRODUCT, ADD_PRODUCT, CHANGE_PRODUCT, REMOVE_PRODUCT,

    // Transactions
    SET_TRANSACTIONS, SET_TRANSACTIONS_PAGINATION, SET_ACTIVE_TRANSACTION, ADD_TRANSACTION, CHANGE_TRANSACTION, REMOVE_TRANSACTION,

    // Users
    SET_USERS, SET_ACTIVE_USER, ADD_USER, CHANGE_USER, REMOVE_USER,

    // Roles
    SET_ROLES, SET_ACTIVE_ROLE, ADD_ROLE, CHANGE_ROLE, REMOVE_ROLE,

    // Permissions
    SET_PERMISSIONS, SET_ACTIVE_PERMISSION, ADD_PERMISSION, CHANGE_PERMISSION, REMOVE_PERMISSION,
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

    // Transactions
    fetchTransactions, fetchTransaction, createTransaction, updateTransaction, deleteTransaction,

    // Users
    fetchUsers, fetchUser, createUser, updateUser, deleteUser,

    // Roles
    fetchRoles, fetchRole, createRole, updateRole, deleteRole,

    // Permissions
    fetchPermissions, fetchPermission, createPermission, updatePermission, deletePermission,
  },
  getters: {},
});
