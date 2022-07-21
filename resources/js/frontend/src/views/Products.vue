<template>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Products</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <material-alert v-if="error.data" class="font-weight-light" color="danger" dismissible>
              <p class="mb-0">{{ error.data.message }}</p>
              <ul>
                <li v-for="a in error.data.errors">
                  <ul>
                    <li v-for="b in a">{{ b }}</li>
                  </ul>
                </li>
              </ul>
            </material-alert>

            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Product
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                      Rate
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                      Quantity
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                      Vendor
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                      Category
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Created By
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Created At
                    </th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Updated At
                    </th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <div class="input-group input-group-outline null">
                            <input v-model="product.name" type="text" class="form-control form-control-default"
                              placeholder="" isrequired="false">
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <div class="input-group input-group-outline null">
                            <input v-model="product.rate" type="text" class="form-control form-control-default"
                              placeholder="" isrequired="true">
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <div class="input-group input-group-outline null">
                            <input v-model="product.quantity" type="text" class="form-control form-control-default"
                              placeholder="" isrequired="false">
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <div class="input-group input-group-outline null">
                            <select v-model="product.vendor_id" class="form-control form-control-default">
                              <option></option>
                              <option v-for="vendor in vendors" :value="vendor.id">{{ vendor.name }}</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <div class="input-group input-group-outline null">
                            <select v-model="product.category_id" class="form-control form-control-default">
                              <option></option>
                              <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">

                    </td>
                    <td class="align-middle text-center">

                    </td>
                    <td class="align-middle text-center">

                    </td>
                    <td class="align-middle">
                      <material-button color="dark" variant="gradient" @click="createProduct">
                        <i class="fas fa-plus me-2"></i>
                        Add New Product
                      </material-button>
                    </td>
                  </tr>

                  <tr v-for="product in products">
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <svg class="barcode border-radius-lg" alt="user6" jsbarcode-format="auto"
                            :jsbarcode-value="product.barcode_identifier" jsbarcode-textmargin="0"
                            jsbarcode-fontoptions="bold">
                          </svg>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm" v-if="product.id !== activeProduct?.id">{{ product.name }}</h6>

                          <div class="input-group input-group-outline" v-if="product.id === activeProduct?.id">
                            <input v-model="activeProduct.name" type="text" class="form-control form-control-default"
                              placeholder="" isrequired="false">
                          </div>
                          <p class="text-xs text-secondary mb-0">
                            {{ product.barcode_identifier }}
                          </p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm" v-if="product.id !== activeProduct?.id">{{ product.rate }}</h6>

                          <div class="input-group input-group-outline" v-if="product.id === activeProduct?.id">
                            <input v-model="activeProduct.rate" type="text" class="form-control form-control-default"
                              placeholder="" isrequired="false">
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm" v-if="product.id !== activeProduct?.id">{{ product.quantity }}</h6>

                          <div class="input-group input-group-outline" v-if="product.id === activeProduct?.id">
                            <input v-model="activeProduct.quantity" type="text"
                              class="form-control form-control-default" placeholder="" isrequired="false">
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm" v-if="product.id !== activeProduct?.id">{{ product.vendor.name }}
                          </h6>

                          <div class="input-group input-group-outline" v-if="product.id === activeProduct?.id">
                            <select v-model="product.vendor_id" class="form-control form-control-default">
                              <option></option>
                              <option v-for="vendor in vendors" :value="vendor.id">{{ vendor.name }}</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm" v-if="product.id !== activeProduct?.id">{{ product.category.name }}
                          </h6>

                          <div class="input-group input-group-outline" v-if="product.id === activeProduct?.id">
                            <select v-model="product.category_id" class="form-control form-control-default">
                              <option></option>
                              <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-success">{{
                          product.user.name
                      }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{
                          moment(product.created_at).fromNow()
                      }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{
                          moment(product.updated_at).fromNow()
                      }}</span>
                    </td>
                    <td class="align-middle">
                      <material-button color="dark" variant="gradient" @click="editProduct(product)"
                        v-if="product.id !== activeProduct?.id">
                        <i class="fas fa-edit me-2"></i>
                        Edit
                      </material-button>

                      <material-button color="dark" variant="gradient" @click="deleteProduct(product)"
                        v-if="product.id !== activeProduct?.id">
                        <i class="fas fa-trash me-2"></i>
                        Delete
                      </material-button>

                      <material-button color="dark" variant="gradient" @click="updateProduct()"
                        v-if="product.id === activeProduct?.id">
                        <i class="fas fa-save me-2"></i>
                        Save
                      </material-button>

                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <pagination align="center" :data="paginationData" @pagination-change-page="list" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import MaterialButton from "../components/MaterialButton.vue";
import MaterialModal from "../components/MaterialModal.vue";
import moment from 'moment'
import JsBarcode from 'jsbarcode'
import Pagination from 'laravel-vue-pagination'
import MaterialAlert from "../components/MaterialAlert.vue";

export default {
  name: "Products",
  components: {
    MaterialButton,
    MaterialModal,
    MaterialAlert,
    Pagination,
  },
  data: function () {
    return {
      showCreateModal: false,
      activeProduct: null,
      product: {
        name: ''
      },
      paginationData: {
        "total": 0,
        'current_page': 1,
        'per_page': 0,
        'prev_page_url': null,
        'next_page_url': null,
      }
    }
  },
  computed: {
    error() {
      return this.$store.state.error
    },
    products() {
      return this.$store.state.products;
    },
    vendors() {
      return this.$store.state.vendors;
    },
    categories() {
      return this.$store.state.categories;
    },
  },
  mounted() {
    this.$store.dispatch("fetchProducts").then(() => {
      JsBarcode(".barcode").init();
    });
    this.$store.dispatch("fetchCategories");
    this.$store.dispatch("fetchVendors");

    this.list(1);
  },
  methods: {
    moment,
    toggleCreateModal() {
      this.showCreateModal = !this.showCreateModal
    },
    createProduct() {
      this.$store.dispatch("createProduct", this.product).then(() => {
        this.product.name = '';
        JsBarcode(".barcode").init();
      })
    },
    deleteProduct(product) {
      this.$store.dispatch("deleteProduct", product)
    },
    editProduct(product) {
      this.$store.dispatch("fetchProduct", product).then(() => {
        this.activeProduct = this.$store.state.activeProduct;
      })
    },
    updateProduct() {
      this.$store.dispatch("updateProduct", this.activeProduct).then(() => {
        this.activeProduct = null;
      });
    },
    list(page = 1) {
      this.$store.dispatch("fetchProducts", page).then(() => {
        const total = this.$store.state.products_total;
        const perPage = this.$store.state.products_per_page;
        this.paginationData = {
          "total": total,
          'current_page': page,
          'per_page': perPage,
          'prev_page_url': page == 1 ? null : (page - 1),
          'next_page_url': page == (total / perPage) ? null : page + 1,
        };
      });
    }
  }
};
</script>
