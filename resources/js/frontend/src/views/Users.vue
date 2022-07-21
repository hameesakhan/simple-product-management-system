<template>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <DataTable ref="usersDataTableRef" id="usersDataTable" class="display w-100" :columns="[
                    { data: 'id', title: 'ID', },
                    { data: 'name', title: 'Name', },
                    { data: 'email', title: 'Email', },
                    { data: 'roles[,].name', title: 'Roles', },
                    { data: 'created_at', title: 'Created At', },
                    { data: 'updated_at', title: 'Updated At', },
                    { data: 'actions', title: 'Actions', },
                
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
        roles() {
            return this.$store.state.roles;
        },
        tableOptions() {
            return {
                buttons: [
                    'copy', 'csvHtml5', 'print', 'colvis', 'searchPanes',
                    {
                        text: 'Create',
                        action: (e, dt, node, config) => {
                            this.$swal.fire({
                                title: 'Create User',
                                html: `
                                    <input type="text" id="name" class="swal2-input" placeholder="Name">
                                    <input type="text" id="email" class="swal2-input" placeholder="Email">
                                    <input type="password" id="password" class="swal2-input" placeholder="Password">
                                    <select id="role" class="swal2-input">
                                        ${this.$store.state.roles.map(role => `<option value="${role.name}">${role.name}</option>`).join("\n")
                                    }
                                    </select>
                                    `,
                                confirmButtonText: 'Create',
                                focusConfirm: false,
                                preConfirm: () => {
                                    const name = this.$swal.getPopup().querySelector('#name').value
                                    const email = this.$swal.getPopup().querySelector('#email').value
                                    const password = this.$swal.getPopup().querySelector('#password').value
                                    const role = this.$swal.getPopup().querySelector('#role').value
                                    if (!name || !email || !password || !role) {
                                        this.$swal.showValidationMessage(`All fields are mandatory`)
                                    }
                                    return { name, email, password, role }
                                }
                            }).then((result) => {
                                this.$store.dispatch('createUser', result.value).then(() => {
                                    dt.draw();
                                })
                            })
                        }
                    },
                    {
                        text: 'Edit',
                        action: (e, dt, node, config) => {
                            const selectedUsers = dt.rows({ selected: true }).data();
                            if (selectedUsers.length) {
                                const selectedUser = selectedUsers[0];
                                const currentRoles = selectedUser.roles.map(r => r.name)
                                this.$swal.fire({
                                    title: 'Edit User',
                                    html: `
                                    <input type="text" id="name" class="swal2-input" placeholder="Name" value="${selectedUser.name}">
                                    <input type="text" id="email" class="swal2-input" placeholder="Email"  value="${selectedUser.email}">
                                    <input type="password" id="password" class="swal2-input" placeholder="Password">
                                    <select id="role" class="swal2-input">
                                        ${this.$store.state.roles.map(role => `<option value="${role.name}" ${currentRoles.indexOf(role.name) !== -1 ? 'selected' : ''}>${role.name}</option>`).join("\n")}
                                    </select>
                                    `,
                                    confirmButtonText: 'Save',
                                    focusConfirm: false,
                                    preConfirm: () => {
                                        const name = this.$swal.getPopup().querySelector('#name').value
                                        const email = this.$swal.getPopup().querySelector('#email').value
                                        const password = this.$swal.getPopup().querySelector('#password').value
                                        const role = this.$swal.getPopup().querySelector('#role').value
                                        if (!name || !email || !role) {
                                            this.$swal.showValidationMessage(`All fields are mandatory except password`)
                                        }
                                        return { name, email, password, role }
                                    }
                                }).then((result) => {
                                    this.$store.dispatch('updateUser', { ...result.value, id: selectedUser.id }).then(() => {
                                        dt.draw();
                                    })
                                })
                            }
                        }
                    },
                    {
                        text: 'Delete',
                        action: (e, dt, node, config) => {
                            const selectedUsers = dt.rows({ selected: true }).data();
                            if (selectedUsers.length) {
                                const selectedUser = selectedUsers[0];
                                this.$swal.fire({
                                    title: 'Are you sure?',
                                    text: "You won't be able to revert this!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, delete it!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        this.$store.dispatch('deleteUser', { id: selectedUser.id }).then(() => {
                                            dt.draw();
                                        })
                                    }
                                })
                            }
                        }
                    }
                ],
                select: {
                    style: 'single'
                },
                searchPanes: {
                    'serverSide': true,
                },
                columnDefs: [

                    { "searchable": false, "targets": [3, 6] },
                    {
                        searchPanes: {
                            show: true,
                        },
                        targets: [1, 2],
                    },
                    {
                        targets: [-1],
                        data: null,
                        render: (data, type, row, meta) => {
                            return ` `
                        }
                    }
                ],
                select: 'single',
                'serverSide': true,
                'processing': true,
                'ajax': {
                    'url': '/api\/user',
                    'type': 'GET',
                },
                'columns': [
                    { 'data': 'id', 'name': 'id', 'title': 'Id', 'orderable': true, 'searchable': true },
                    { 'data': 'name', 'name': 'name', 'title': 'Name', 'orderable': true, 'searchable': true },
                    { 'data': 'email', 'name': 'email', 'title': 'Email', 'orderable': true, 'searchable': true },
                    { 'data': 'roles', 'name': 'roles', 'title': 'Email', 'orderable': false, 'searchable': false },
                    { 'data': 'created_at', 'name': 'created_at', 'title': 'Created At', 'orderable': true, 'searchable': true },
                    { 'data': 'updated_at', 'name': 'updated_at', 'title': 'Updated At', 'orderable': true, 'searchable': true },
                    { 'data': 'action', 'name': 'action', 'title': 'Action', 'orderable': false, 'searchable': false, 'width': 60, 'className': 'text-center' },
                ],
                'dom': 'Bfrtip',
                'order': [[1, 'desc']],

            };
        }
    },
    mounted() {
        this.$store.dispatch('fetchRoles');
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
