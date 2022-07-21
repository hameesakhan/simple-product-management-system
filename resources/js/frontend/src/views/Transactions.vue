<template>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
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

        <transaction-list />
      </div>
    </div>
  </div>
</template>

<script>
import MaterialButton from "../components/MaterialButton.vue";
import TransactionList from "./components/TransactionList.vue";
import MaterialModal from "../components/MaterialModal.vue";
import MaterialAlert from "../components/MaterialAlert.vue";

export default {
  name: "Vendors",
  components: {
    MaterialButton,
    MaterialAlert,
    MaterialModal,
    TransactionList,

  },
  data: function () {
    return {

    }
  },
  computed: {
    error() {
      return this.$store.state.error
    },
  },
  mounted() {
  },
  methods: {
  }
};
</script>
