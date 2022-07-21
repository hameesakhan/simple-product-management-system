<template>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <DataTable class="display w-100" :columns="[
                    { data: 'id', title: 'ID', },
                    { data: 'name', title: 'Name', },
                    { data: 'email', title: 'Email', },
                    { data: 'created_at', title: 'Created At', },
                    { data: 'updated_at', title: 'Updated At', },
                
                ]" :options="tableOptions" />
            </div>
        </div>
    </div>
</template>

<script>
import DataTable from 'datatables.net-vue3';
import DataTableBs5 from 'datatables.net-bs5';
import Responsive from 'datatables.net-responsive-bs5';

import Buttons from 'datatables.net-buttons-bs5';
import ButtonsPrint from 'datatables.net-buttons/js/buttons.print';
import ButtonsColVis from 'datatables.net-buttons/js/buttons.colVis';
import ButtonsHTML5 from 'datatables.net-buttons/js/buttons.html5';

import SearchPanes from 'datatables.net-searchpanes-bs5';
import Select from 'datatables.net-select-bs5';


DataTable.use(DataTableBs5);
DataTable.use(Responsive);

DataTable.use(Buttons);
DataTable.use(ButtonsPrint);
DataTable.use(ButtonsHTML5);
DataTable.use(ButtonsColVis);

DataTable.use(SearchPanes);
DataTable.use(Select);

export default {
    name: "Users",
    components: {
        DataTable
    },
    data: function () {
        return {

        }
    },
    computed: {
        tableOptions() {
            return {
                buttons: [
                    'copy', 'csvHtml5', 'print', 'colvis', 'searchPanes',
                    {
                        text: 'Create',
                        action: (e, dt, node, config) => {
                            this.$swal.fire({
                                title: 'Login Form',
                                html: `<input type="text" id="login" class="swal2-input" placeholder="Username">
  <input type="password" id="password" class="swal2-input" placeholder="Password">`,
                                confirmButtonText: 'Sign in',
                                focusConfirm: false,
                                preConfirm: () => {
                                    const login = this.$swal.getPopup().querySelector('#login').value
                                    const password = this.$swal.getPopup().querySelector('#password').value
                                    if (!login || !password) {
                                        this.$swal.showValidationMessage(`Please enter login and password`)
                                    }
                                    return { login: login, password: password }
                                }
                            }).then((result) => {
                                this.$swal.fire(`
    Login: ${result.value.login}
    Password: ${result.value.password}
  `.trim())
                            })
                        }
                    }
                ],
                select: true,
                searchPanes: {
                    'serverSide': true,
                },
                columnDefs: [
                    {
                        searchPanes: {
                            show: true,
                        },
                        targets: [1, 2],
                    },
                    {
                        targets: [-1],
                        data: null,
                        defaultContent: '<button>Click!</button>',
                    }
                ],
                'serverSide': true,
                'processing': true,
                'ajax': {
                    'url': '/api\/user',
                    'type': 'GET',
                    // 'data': function (data) {
                    //     for (var i = 0, len = data.columns.length; i < len; i++) {
                    //         if (!data.columns[i].search.value) delete data.columns[i].search;
                    //         if (data.columns[i].searchable === true) delete data.columns[i].searchable;
                    //         if (data.columns[i].orderable === true) delete data.columns[i].orderable;
                    //         if (data.columns[i].data === data.columns[i].name) delete data.columns[i].name;
                    //     }
                    //     delete data.search.regex;
                    // },
                },
                'columns': [
                    { 'data': 'action', 'name': 'action', 'title': 'Action', 'orderable': false, 'searchable': false, 'width': 60, 'className': 'text-center' },
                    { 'data': 'created_at', 'name': 'created_at', 'title': 'Created At', 'orderable': true, 'searchable': true },
                    { 'data': 'email', 'name': 'email', 'title': 'Email', 'orderable': true, 'searchable': true },
                    { 'data': 'email_verified_at', 'name': 'email_verified_at', 'title': 'Email Verified At', 'orderable': true, 'searchable': true },
                    { 'data': 'id', 'name': 'id', 'title': 'Id', 'orderable': true, 'searchable': true },
                    { 'data': 'name', 'name': 'name', 'title': 'Name', 'orderable': true, 'searchable': true },
                    { 'data': 'updated_at', 'name': 'updated_at', 'title': 'Updated At', 'orderable': true, 'searchable': true },
                ],
                'dom': 'Bfrtip',
                'order': [[1, 'desc']],

            };
        }
    },
    mounted() {
    },
    methods: {
    }
};
</script>

<style>
@import 'bootstrap';
@import 'datatables.net-bs5';
@import 'datatables.net-select-bs5';
@import "datatables.net-buttons-bs5";
@import "datatables.net-searchpanes-bs5";
</style>
