<template>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Roles</h6>
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
                            <input v-model="role.name" type="text" class="form-control form-control-default"
                              placeholder="" isrequired="false">
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">

                    </td>
                    <td class="align-middle text-center">

                    </td>
                    <td class="align-middle">
                      <material-button color="dark" variant="gradient" @click="createRole">
                        <i class="fas fa-plus me-2"></i>
                        Add New Role
                      </material-button>
                    </td>
                  </tr>

                  <tr v-for="role in roles">
                    <td>
                      <p class="text-xs font-weight-bold mb-0">{{ role.id }}</p>
                    </td>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm" v-if="role.id !== activeRole?.id">{{ role.name }}</h6>

                          <div class="input-group input-group-outline" v-if="role.id === activeRole?.id">
                            <input v-model="activeRole.name" type="text" class="form-control form-control-default"
                              placeholder="" isrequired="false">
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{
                          moment(role.created_at).fromNow()
                      }}</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{
                          moment(role.updated_at).fromNow()
                      }}</span>
                    </td>
                    <td class="align-middle">
                      <material-button color="dark" variant="gradient" @click="editRole(role)"
                        v-if="role.id !== activeRole?.id">
                        <i class="fas fa-edit me-2"></i>
                        Edit
                      </material-button>

                      <material-button color="dark" variant="gradient" @click="deleteRole(role)"
                        v-if="role.id !== activeRole?.id">
                        <i class="fas fa-trash me-2"></i>
                        Delete
                      </material-button>

                      <material-button color="dark" variant="gradient" @click="updateRole()"
                        v-if="role.id === activeRole?.id">
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
import moment from 'moment'
import MaterialAlert from "../components/MaterialAlert.vue";

export default {
  name: "Roles",
  components: {
    MaterialAlert,
    MaterialButton,
    MaterialModal,
  },
  data: function () {
    return {
      showCreateModal: false,
      activeRole: null,
      role: {
        name: ''
      }
    }
  },
  computed: {
    error() {
      return this.$store.state.error
    },
    roles() {
      return this.$store.state.roles;
    },
  },
  mounted() {
    this.$store.dispatch("fetchRoles");
  },
  methods: {
    moment,
    toggleCreateModal() {
      this.showCreateModal = !this.showCreateModal
    },
    createRole() {
      this.$store.dispatch("createRole", this.role).then(() => {
        this.role.name = '';
      })
    },
    deleteRole(role) {
      this.$store.dispatch("deleteRole", role)
    },
    editRole(role) {
      this.$store.dispatch("fetchRole", role).then(() => {
        this.activeRole = this.$store.state.activeRole;
      })
    },
    updateRole() {
      this.$store.dispatch("updateRole", this.activeRole).then(() => {
        this.activeRole = null;
        this.$store.dispatch("fetchRoles");
      });
    }
  }
};
</script>
