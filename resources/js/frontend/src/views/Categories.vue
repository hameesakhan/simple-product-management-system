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

                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <div class="input-group input-group-outline null">
                            <label class="form-label">Name</label>
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
                      <button @click="createCategory" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                        data-original-title="Add Category">
                        Add
                      </button>
                    </td>
                  </tr>

                  <tr v-for="category in categories">
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ category.id }}</p>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{ category.name }}</h6>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-success">{{ category.user.name }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ category.created_at }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ category.updated_at }}</span>
                    </td>
                    <td class="align-middle">
                      <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                        data-original-title="Edit user">
                        Edit
                      </a>
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
  name: "Categories",
  components: {
    MaterialButton,
    MaterialModal,
  },
  data: function () {
    return {
      showCreateModal: false,
      category: {
        name: ''
      }
    }
  },
  computed: {
    categories() {
      return this.$store.state.categories;
    },
  },
  mounted() {
    this.$store.dispatch("fetchCategories");
  },
  methods: {
    toggleCreateModal() {
      this.showCreateModal = !this.showCreateModal
    },
    createCategory(){
      
    }
  }
};
</script>
