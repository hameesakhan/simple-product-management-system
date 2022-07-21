import axios from 'axios'

export function SET_VENDORS(state, vendors) {
    state.vendors = vendors
}

export function SET_ACTIVE_VENDOR(state, vendor) {
    state.activeVendor = vendor
}

export function ADD_VENDOR(state, vendor) {
    state.vendors = [...state.vendors, vendor]
}

export function CHANGE_VENDOR(state, vendor) {
    state.vendors = state.vendors.map(t => t.id == vendor.id ? vendor : t)
}

export function REMOVE_VENDOR(state, id) {
    const newList = state.vendors.filter(t => t.id !== id);
    state.vendors = newList;
}

export async function fetchVendors({ commit }) {
    try {
        const response = await axios.get('/api/vendor')
        commit('SET_VENDORS', response.data.vendors)
        commit('setError', { title: null, data: null })
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}

export async function fetchVendor({ commit }, { id }) {
    try {
        const response = await axios.get('/api/vendor/' + id)
        commit('SET_ACTIVE_VENDOR', response.data.vendor)
        commit('setError', { title: null, data: null })
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}

export async function createVendor({ commit }, vendor) {
    try {
        const response = await axios.post('/api/vendor', vendor)
        commit('ADD_VENDOR', response.data.vendor)
        commit('setError', { title: null, data: null })
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}

export async function updateVendor({ commit }, vendor) {
    try {
        const response = await axios.put('/api/vendor/' + vendor.id, vendor)
        commit('CHANGE_VENDOR', response.data.vendor)
        commit('setError', { title: null, data: null })
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}

export async function deleteVendor({ commit }, { id }) {
    try {
        const response = await axios.delete('/api/vendor/' + id)
        commit('REMOVE_VENDOR', id)
        commit('setError', { title: null, data: null })
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}