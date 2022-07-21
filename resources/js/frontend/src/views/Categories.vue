<template>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Categories</h6>
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
                      ID
                    </th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                      Name
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
                            <input v-model="category.name" type="text" class="form-control form-control-default"
                              placeholder="" isrequired="false">
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
                      <material-button color="dark" variant="gradient" @click="createCategory">
                        <i class="fas fa-plus me-2"></i>
                        Add New Category
                      </material-button>
                    </td>
                  </tr>

                  <tr v-for="category in categories">
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ category.id }}</p>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm" v-if="category.id !== activeCategory?.id">{{ category.name }}</h6>

                          <div class="input-group input-group-outline" v-if="category.id === activeCategory?.id">
                            <input v-model="activeCategory.name" type="text" class="form-control form-control-default"
                              placeholder="" isrequired="false">
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-success">{{
                          category.user.name
                      }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{
                          moment(category.created_at).fromNow()
                      }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{
                          moment(category.updated_at).fromNow()
                      }}</span>
                    </td>
                    <td class="align-middle">
                      <material-button color="dark" variant="gradient" @click="editCategory(category)"
                        v-if="category.id !== activeCategory?.id">
                        <i class="fas fa-edit me-2"></i>
                        Edit
                      </material-button>

                      <material-button color="dark" variant="gradient" @click="deleteCategory(category)"
                        v-if="category.id !== activeCategory?.id">
                        <i class="fas fa-trash me-2"></i>
                        Delete
                      </material-button>

                      <material-button color="dark" variant="gradient" @click="updateCategory()"
                        v-if="category.id === activeCategory?.id">
                        <i class="fas fa-save-o me-2"></i>
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
import moment from 'moment'
import MaterialAlert from "../components/MaterialAlert.vue";


export default {
  name: "Categories",
  components: {
    MaterialButton,
    MaterialAlert,
    MaterialModal,
  },
  data: function () {
    return {
      showCreateModal: false,
      activeCategory: null,
      category: {
        name: ''
      }
    }
  },
  computed: {
    error() {
      return this.$store.state.error
    },
    categories() {
      return this.$store.state.categories;
    },
  },
  mounted() {
    this.$store.dispatch("fetchCategories");
  },
  methods: {
    moment,
    toggleCreateModal() {
      this.showCreateModal = !this.showCreateModal
    },
    createCategory() {
      this.$store.dispatch("createCategory", this.category).then(() => {
        this.category.name = '';
      })
    },
    deleteCategory(category) {
      this.$store.dispatch("deleteCategory", category)
    },
    editCategory(category) {
      this.$store.dispatch("fetchCategory", category).then(() => {
        this.activeCategory = this.$store.state.activeCategory;
      })
    },
    updateCategory() {
      this.$store.dispatch("updateCategory", this.activeCategory).then(() => {
        this.activeCategory = null;
        this.$store.dispatch("fetchCategories");
      });
    }
  }
};
</script>
