<template>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Vendors</h6>
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
                      <p class="text-xs font-weight-bold mb-0">NEW</p>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <div class="input-group input-group-outline null">
                            <label class="form-label">Name</label>
                            <input v-model="vendor.name" type="text" class="form-control form-control-default"
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
                      <material-button color="dark" variant="gradient" @click="createVendor">
                        <i class="fas fa-plus me-2"></i>
                        Add New Vendor
                      </material-button>
                    </td>
                  </tr>

                  <tr v-for="vendor in vendors">
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ vendor.id }}</p>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm" v-if="vendor.id !== activeVendor?.id">{{ vendor.name }}</h6>

                          <div class="input-group input-group-outline" v-if="vendor.id === activeVendor?.id">
                            <label class="form-label">Name</label>
                            <input v-model="activeVendor.name" type="text" class="form-control form-control-default"
                              placeholder="" isrequired="false">
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-success">{{
                          vendor.user.name
                      }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{
                          vendor.created_at
                      }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{
                          vendor.updated_at
                      }}</span>
                    </td>
                    <td class="align-middle">
                      <material-button color="dark" variant="gradient" @click="editVendor(vendor)"
                        v-if="vendor.id !== activeVendor?.id">
                        <i class="fas fa-edit me-2"></i>
                        Edit
                      </material-button>

                      <material-button color="dark" variant="gradient" @click="deleteVendor(vendor)"
                        v-if="vendor.id !== activeVendor?.id">
                        <i class="fas fa-trash me-2"></i>
                        Delete
                      </material-button>

                      <material-button color="dark" variant="gradient" @click="updateVendor()"
                        v-if="vendor.id === activeVendor?.id">
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
  name: "Vendors",
  components: {
    MaterialButton,
    MaterialModal,
  },
  data: function () {
    return {
      showCreateModal: false,
      activeVendor: null,
      vendor: {
        name: ''
      }
    }
  },
  computed: {
    vendors() {
      return this.$store.state.vendors;
    },
  },
  mounted() {
    this.$store.dispatch("fetchVendors");
  },
  methods: {
    toggleCreateModal() {
      this.showCreateModal = !this.showCreateModal
    },
    createVendor() {
      this.$store.dispatch("createVendor", this.vendor).then(() => {
        this.vendor.name = '';
      })
    },
    deleteVendor(vendor) {
      this.$store.dispatch("deleteVendor", vendor)
    },
    editVendor(vendor) {
      this.$store.dispatch("fetchVendor", vendor).then(() => {
        this.activeVendor = this.$store.state.activeVendor;
      })
    },
    updateVendor() {
      this.$store.dispatch("updateVendor", this.activeVendor).then(() => {
        this.activeVendor = null;
        this.$store.dispatch("fetchVendors");
      });
    }
  }
};
</script>
