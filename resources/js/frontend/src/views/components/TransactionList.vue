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
                v-on:dblclick="initQuagga()" v-on:blur="stopQuagga()" v-on:keyup.enter="searchProduct()" />
              <div id="cameraPreview" style="display: none;"></div>
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
                <input type="number" name="" id="" v-model="transaction.quantity" class="form-control"
                  ref="newQuantity">
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
      <pagination align="center" :data="paginationData" @pagination-change-page="list" />
    </div>
  </div>
</template>

<script>
import moment from 'moment'
import axios from 'axios'
import Quagga from 'quagga';
import Pagination from 'laravel-vue-pagination'

export default {
  name: "transaction-list",
  components: {
    Pagination
  },
  data: function () {
    return {
      showCreateModal: false,
      activeTransaction: null,
      transaction: {
        transaction_date: moment().format('Y-MM-D'),
        product: { barcode_identifier: '' },
        transaction_type: 'IN',
        quantity: 0
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
    transactions() {
      return this.$store.state.transactions;
    },
  },
  mounted() {
    this.$store.dispatch("fetchTransactions");
    this.list(1);
  },
  methods: {
    moment,
    searchProduct() {
      axios.get(`/api/product?barcode_identifier=${this.transaction.product.barcode_identifier}`)
        .then(response => {
          const product = response.data.product;

          this.transaction.product = {
            name: product.name,
            rate: product.rate,
            quantity: product.quantity,
            barcode_identifier: product.barcode_identifier
          };
          this.transaction.product_id = product.id;
          this.$refs.newQuantity.focus();
          // this.$refs.newQuantity.setSelectionRange(0, 99);
        })
        .catch((err) => {
          if (err.response) {
            // handle err
            this.transaction.product.barcode_identifier = '';
            console.log(err);
            this.$swal(err.response.statusText, err.response.data.message, 'err');
          }
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
    },
    barcodeHandler(e) {
      console.log("Barcode detected");
      if (e.codeResult.format == 'code_128') {
        this.transaction.product.barcode_identifier = e.codeResult.code;
        this.transaction.quantity = 1;
        this.searchProduct();
      }
    },
    initQuagga(event) {
      Quagga.init({
        frequency: 1, // max num of input frame scans per second
        locate: true,
        debug: false,
        inputStream: {
          name: "Live",
          type: "LiveStream",
          target: document.querySelector('#cameraPreview'),    // Or '#yourElement' (optional)
          constraints: {
            width: 1280,
            height: 960,
            facing: "facingMode" // or user
          }
        },
        decoder: {
          multiple: false,
          readers: [
            'code_128_reader',
          ],
          debug: {
            drawBoundingBox: true,
            showFrequency: true,
            drawScanline: true,
            showPattern: true
          }
        },
        locator: {
          halfSample: true,
          patchSize: "medium", // x-small, small, medium, large, x-large
          debug: {
            showCanvas: false,
            showPatches: false,
            showFoundPatches: false,
            showSkeleton: false,
            showLabels: false,
            showPatchLabels: false,
            showRemainingPatchLabels: false,
            boxFromPatches: {
              showTransformed: false,
              showTransformedBox: false,
              showBB: false
            }
          }
        }


      }, (err) => {
        if (err) {
          console.log(err);
          return
        }
        console.log("Initialization finished. Ready to start");
        Quagga.onDetected(this.barcodeHandler);
        Quagga.start();
      });


    },
    stopQuagga(event) {
      Quagga.offDetected(this.barcodeHandler);
      Quagga.stop();
      console.log("Barcode searching stopped");
      const preview = document.querySelector('#cameraPreview')
      while (preview.firstChild) {
        preview.removeChild(preview.lastChild);
      }
    },
    list(page = 1) {
      this.$store.dispatch("fetchTransactions", page).then(() => {
        const total = this.$store.state.transactions_total;
        const perPage = this.$store.state.transactions_per_page;
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
