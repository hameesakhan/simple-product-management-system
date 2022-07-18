import axios from 'axios'

export function SET_PRODUCTS(state, products) {
    state.products = products
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

export async function fetchProducts({ commit }) {
    try {
        const response = await axios.get('/api/product')
        commit('SET_PRODUCTS', response.data.products)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function fetchProduct({ commit }, { id }) {
    try {
        const response = await axios.get('/api/product/' + id)
        commit('SET_ACTIVE_PRODUCT', response.data.product)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function createProduct({ commit }, product) {
    try {
        const response = await axios.post('/api/product', product)
        commit('ADD_PRODUCT', response.data.product)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function updateProduct({ commit }, product) {
    try {
        const response = await axios.put('/api/product/' + product.id, product)
        commit('CHANGE_PRODUCT', response.data.product)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function markProductComplete({ commit }, product) {
    try {
        const response = await axios.put('/api/product/' + product.id, { ...product, is_complete: true })
        commit('CHANGE_PRODUCT', response.data.product)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function deleteProduct({ commit }, { id }) {
    try {
        const response = await axios.delete('/api/product/' + id)
        commit('REMOVE_PRODUCT', id)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}