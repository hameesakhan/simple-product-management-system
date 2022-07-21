import axios from 'axios'

export function SET_PRODUCTS(state, products) {
    state.products = products
}

export function SET_PRODUCTS_PAGINATION(state, paginate) {
    state.products_total = paginate.total
    state.products_per_page = paginate.per_page
}

export function SET_ACTIVE_PRODUCT(state, product) {
    state.activeProduct = product
}

export function ADD_PRODUCT(state, product) {
    state.products = [...state.products, product]
}

export function CHANGE_PRODUCT(state, product) {
    state.products = state.products.map(t => t.id == product.id ? product : t)
}

export function REMOVE_PRODUCT(state, id) {
    const newList = state.products.filter(t => t.id !== id);
    state.products = newList;
}

export async function fetchProducts({ commit }, page = 1) {
    try {
        const response = await axios.get(`/api/product?page=${page}`)
        commit('SET_PRODUCTS', response.data.products.data)
        commit('SET_PRODUCTS_PAGINATION', { total: response.data.total, per_page: response.data.per_page })
        commit('setError', { title: null, data: null })
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}

export async function fetchProduct({ commit }, { id }) {
    try {
        const response = await axios.get('/api/product/' + id)
        commit('SET_ACTIVE_PRODUCT', response.data.product)
        commit('setError', { title: null, data: null })
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}

export async function createProduct({ commit }, product) {
    try {
        const response = await axios.post('/api/product', product)
        commit('ADD_PRODUCT', response.data.product)
        commit('setError', { title: null, data: null })
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}

export async function updateProduct({ commit }, product) {
    try {
        const response = await axios.put('/api/product/' + product.id, product)
        commit('CHANGE_PRODUCT', response.data.product)
        commit('setError', { title: null, data: null })
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}

export async function deleteProduct({ commit }, { id }) {
    try {
        const response = await axios.delete('/api/product/' + id)
        commit('REMOVE_PRODUCT', id)
        commit('setError', { title: null, data: null })
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}