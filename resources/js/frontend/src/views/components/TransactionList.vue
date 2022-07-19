<template>
  <div class="card">
    <div class="card-header pb-0 px-3">
      <h6 class="mb-0"></h6>
    </div>
    <div class="card-body pt-4 p-3">
      <ul class="list-group">
        <li class="list-group-item border-0 d-flex p-4 mb-2 border-radius-lg bg-gray-100">
          <div class="d-flex flex-row">
            <span class="mb-2 text-xs">
              Transaction Date:
              <input type="date" v-model="transaction.transaction_date" class="form-control" />
            </span>
            <span class="mb-2 text-xs">
              Barcode Identifier:
              <input type="number" v-model="transaction.product.barcode_identifier" class="form-control"
                v-on:keyup.enter="searchProduct()" />
            </span>
            <span class="mb-2 text-xs">
              Product Name:
              <input type="text" name="" id="" v-model="transaction.product.name" class="form-control" disabled />
            </span>
            <span class="mb-2 text-xs">
              Available Quantity:
              <input type="text" name="" id="" v-model="transaction.product.quantity" class="form-control" disabled />
            </span>
            <span class="mb-2 text-xs">
              Rate:
              <input type="text" name="" id="" v-model="transaction.product.rate" class="form-control" disabled />
            </span>
            <span class="mb-2 text-xs">
              Quantity:
              <span class="text-dark ms-sm-2 font-weight-bold">
                <input type="number" name="" id="" v-model="transaction.quantity" class="form-control">
              </span>
            </span>
            <span class="text-xs">
              Transaction Type:
              <span class="text-dark ms-sm-2 font-weight-bold">
                <select name="" id="" v-model="transaction.transaction_type" class="form-control">
                  <option value="IN">IN</option>
                  <option value="OUT">OUT</option>
                </select>
              </span>
            </span>
          </div>
          <div class="ms-auto text-end">
            <button type="button" class="btn btn-link text-dark px-3 mb-0" @click="createTransaction()">
              <i class="fas fa-plus text-dark me-2" aria-hidden="true"></i>Add
            </button>
          </div>
        </li>
        <li v-for="transaction in transactions" class="list-group-item border-0 d-flex p-4 mb-2 border-radius-lg"
          :class="{
            'bg-gray-400': transaction.transaction_type == 'OUT',
            'bg-gray-100': transaction.transaction_type == 'IN'
          }">
          <div class="d-flex flex-column">
            <h6 class="mb-3 text-sm">
              Transaction Id #{{ transaction.id }}
            </h6>
            <span class="mb-2 text-xs">
              Product Name:
              <span class="text-dark font-weight-bold ms-sm-2">{{ transaction.product?.name }}</span>
            </span>
            <span class="mb-2 text-xs">
              Quantity:
              <span class="text-dark ms-sm-2 font-weight-bold">{{ transaction.quantity }}</span>
            </span>
            <span class="text-xs">
              Transaction Type:
              <span class="text-dark ms-sm-2 font-weight-bold">{{ transaction.transaction_type }}</span>
            </span>
            <span class="text-xs">
              Done by:
              <span class="text-dark ms-sm-2 font-weight-bold">{{ transaction.user?.name }}</span>
            </span>
          </div>
          <div class="ms-auto text-end">
            <span class="text-dark font-weight-bold ms-sm-2 float-right">{{
                moment(transaction.transaction_date).fromNow()
            }}</span><br />

            <a class="btn btn-link text-danger text-gradient px-3 mb-0" @click="deleteTransaction(transaction)">
              <i class="far fa-trash-alt me-2" aria-hidden="true"></i>Delete
            </a>
              <!-- <a class="btn btn-link text-dark px-3 mb-0" @click="editTransaction(transaction)">
                <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit
              </a> -->
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import moment from 'moment'
import axios from 'axios'

export default {
  name: "transaction-list",
  components: {
  },
  data: function () {
    return {
      showCreateModal: false,
      activeTransaction: null,
      transaction: {
        transaction_date: moment().format('Y-m-d'),
        product: { barcode_identifier: '' },
        transaction_type: 'IN',
        quantity: 0
      }
    }
  },
  computed: {
    transactions() {
      return this.$store.state.transactions;
    },
  },
  mounted() {
    this.$store.dispatch("fetchTransactions");
  },
  methods: {
    moment,
    searchProduct() {
      axios.get(`/api/product?barcode_identifier=${this.transaction.product.barcode_identifier}`).then(response => {
        const product = response.data.product;

        this.transaction.product = {
          name: product.name,
          rate: product.rate,
          quantity: product.quantity,
          barcode_identifier: product.barcode_identifier
        };
        this.transaction.product_id = product.id;
      })
    },
    toggleCreateModal() {
      this.showCreateModal = !this.showCreateModal
    },
    createTransaction() {
      this.$store.dispatch("createTransaction", this.transaction).then(() => {
      })
    },
    deleteTransaction(transaction) {
      this.$store.dispatch("deleteTransaction", transaction)
    },
    // editTransaction(transaction) {
    //   this.$store.dispatch("fetchTransaction", transaction).then(() => {
    //     this.activeTransaction = this.$store.state.activeTransaction;
    //   })
    // },
    updateTransaction() {
      this.$store.dispatch("updateTransaction", this.activeTransaction).then(() => {
        this.activeTransaction = null;
      });
    }
  }
};
</script>
