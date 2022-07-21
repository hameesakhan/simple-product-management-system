<template>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-success shadow-success border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Permissions table</h6>
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
              <table class="table table-hover align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      Permission
                    </th>
                    <th v-for="role in roles"
                      class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                      {{ role.name }}
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="permission in permissions">
                    <td>
                      {{ startCase(permission.name) }}
                    </td>
                    <td v-for="role in roles" class="align-middle text-center">
                      <input type="checkbox" class=""
                        :checked="!!(role.permissions.find(p => p.name == permission.name))"
                        @input="event => changePermission(role.id, permission.name, event.target.checked)">
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
import MaterialAlert from "../components/MaterialAlert.vue";

export default {
  name: "permissions",
  components: {
    MaterialAlert,
  },
  mounted() {
    this.$store.dispatch("fetchRoles");
    this.$store.dispatch("fetchPermissions");
  },
  methods: {
    startCase(text) {
      const result = text.replace(/([A-Z])/g, " $1");
      const finalResult = result.charAt(0).toUpperCase() + result.slice(1);
      return finalResult
    },
    changePermission(roleId, permissionName, value) {
      let currentPermissions = this.$store.state.roles.find(r => r.id == roleId).permissions.map(p => p.name)

      if (value) {
        currentPermissions.push(permissionName);
      } else {
        currentPermissions = currentPermissions.filter(cP => cP !== permissionName);
      }

      this.$store.dispatch("updatePermissionsOfRole", { roleId, permissions: currentPermissions });
    }
  },
  computed: {
    error() {
      return this.$store.state.error
    },
    roles() {
      return this.$store.state.roles;
    },
    permissions() {
      return this.$store.state.permissions;
    },
  },

};
</script>
