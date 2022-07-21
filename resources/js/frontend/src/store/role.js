import axios from 'axios'

export function SET_ROLES(state, roles) {
    state.roles = roles
}

export function SET_ACTIVE_ROLE(state, role) {
    state.activeRole = role
}

export function ADD_ROLE(state, role) {
    state.roles = [...state.roles, role]
}

export function CHANGE_ROLE(state, role) {
    state.roles = state.roles.map(t => t.id == role.id ? role : t)
}

export function REMOVE_ROLE(state, id) {
    const newList = state.roles.filter(t => t.id !== id);
    state.roles = newList;
}

export async function fetchRoles({ commit }) {
    try {
        const response = await axios.get('/api/role')
        commit('SET_ROLES', response.data.roles)
        commit('setError', { title: null, data: null })
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}

export async function fetchRole({ commit }, { id }) {
    try {
        const response = await axios.get('/api/role/' + id)
        commit('SET_ACTIVE_ROLE', response.data.role)
        commit('setError', { title: null, data: null })
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}

export async function createRole({ commit }, role) {
    try {
        const response = await axios.post('/api/role', role)
        commit('ADD_ROLE', response.data.role)
        commit('setError', { title: null, data: null })
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}

export async function updateRole({ commit }, role) {
    try {
        const response = await axios.put('/api/role/' + role.id, role)
        commit('CHANGE_ROLE', response.data.role)
        commit('setError', { title: null, data: null })
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}

export async function deleteRole({ commit }, { id }) {
    try {
        const response = await axios.delete('/api/role/' + id)
        commit('REMOVE_ROLE', id)
        commit('setError', { title: null, data: null })
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}

export async function updatePermissionsOfRole({ commit }, { roleId, permissions }) {
    try {
        const response = await axios.put('/api/role/' + roleId + '/permissions', { permissions: permissions })
        commit('CHANGE_ROLE', response.data.role)
        commit('setError', { title: null, data: null })
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}