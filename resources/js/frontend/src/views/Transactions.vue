<template>
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <transaction-list />
      </div>
    </div>
  </div>
</template>

<script>
import MaterialButton from "../components/MaterialButton.vue";
import TransactionList from "./components/TransactionList.vue";
import MaterialModal from "../components/MaterialModal.vue";

export default {
  name: "Vendors",
  components: {
    MaterialButton,
    MaterialModal,
    TransactionList,

  },
  data: function () {
    return {

    }
  },
  computed: {

  },
  mounted() {
  },
  methods: {
  }
};
</script>
