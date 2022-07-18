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
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      ID
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                      Name
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
                      <p class="text-xs font-weight-bold mb-0">NEW</p>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <div class="input-group input-group-outline null">
                            <label class="form-label">Name</label>
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
                            <label class="form-label">Rate</label>
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
                            <label class="form-label">Quantity</label>
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
                            <label class="form-label">Vendor</label>
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
                            <label class="form-label">Category</label>
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
                      <p class="text-xs font-weight-bold mb-0">{{ product.id }}</p>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm" v-if="product.id !== activeProduct?.id">{{ product.name }}</h6>

                          <div class="input-group input-group-outline" v-if="product.id === activeProduct?.id">
                            <label class="form-label">Name</label>
                            <input v-model="activeProduct.name" type="text" class="form-control form-control-default"
                              placeholder="" isrequired="false">
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm" v-if="product.id !== activeProduct?.id">{{ product.rate }}</h6>

                          <div class="input-group input-group-outline" v-if="product.id === activeProduct?.id">
                            <label class="form-label">Rate</label>
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
                            <label class="form-label">Quantity</label>
                            <input v-model="activeProduct.quantity" type="text" class="form-control form-control-default"
                              placeholder="" isrequired="false">
                          </div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm" v-if="product.id !== activeProduct?.id">{{ product.vendor.name }}</h6>

                          <div class="input-group input-group-outline" v-if="product.id === activeProduct?.id">
                            <label class="form-label">Quantity</label>
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
                          <h6 class="mb-0 text-sm" v-if="product.id !== activeProduct?.id">{{ product.category.name }}</h6>

                          <div class="input-group input-group-outline" v-if="product.id === activeProduct?.id">
                            <label class="form-label">Quantity</label>
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
                          product.created_at
                      }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{
                          product.updated_at
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
                        <i class="fas fa-floppy-o me-2"></i>
                        Save
                      </material-button>

                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import MaterialButton from "../components/MaterialButton.vue";
import MaterialModal from "../components/MaterialModal.vue";

export default {
  name: "Products",
  components: {
    MaterialButton,
    MaterialModal,
  },
  data: function () {
    return {
      showCreateModal: false,
      activeProduct: null,
      product: {
        name: ''
      }
    }
  },
  computed: {
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
    this.$store.dispatch("fetchProducts");
    this.$store.dispatch("fetchCategories");
    this.$store.dispatch("fetchVendors");
  },
  methods: {
    toggleCreateModal() {
      this.showCreateModal = !this.showCreateModal
    },
    createProduct() {
      this.$store.dispatch("createProduct", this.product).then(() => {
        this.product.name = '';
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
        this.$store.dispatch("fetchProducts");
      });
    }
  }
};
</script>
