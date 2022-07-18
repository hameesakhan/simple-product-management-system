import axios from 'axios'

export function SET_CATEGORIES(state, categories) {
    state.categories = categories
}

export function SET_ACTIVE_CATEGORY(state, category) {
    state.activeCategory = category
}

export function ADD_CATEGORY(state, category) {
    state.categories = [...state.categories, category]
}

export function CHANGE_CATEGORY(state, category) {
    state.categories = state.categories.map(t => t.id == category.id ? category : t)
}

export function REMOVE_CATEGORY(state, id) {
    const newList = state.categories.filter(t => t.id !== id);
    state.categories = newList;
}

export async function fetchCategories({ commit }) {
    try {
        const response = await axios.get('/api/category')
        commit('SET_CATEGORIES', response.data.categories)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function fetchCategory({ commit }, { id }) {
    try {
        const response = await axios.get('/api/category/' + id)
        commit('SET_ACTIVE_CATEGORY', response.data.category)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function createCategory({ commit }, category) {
    try {
        const response = await axios.post('/api/category', category)
        commit('ADD_CATEGORY', response.data.category)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function updateCategory({ commit }, category) {
    try {
        const response = await axios.put('/api/category/' + category.id, category)
        commit('CHANGE_CATEGORY', response.data.category)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function markCategoryComplete({ commit }, category) {
    try {
        const response = await axios.put('/api/category/' + category.id, { ...category, is_complete: true })
        commit('CHANGE_CATEGORY', response.data.category)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function deleteCategory({ commit }, { id }) {
    try {
        const response = await axios.delete('/api/category/' + id)
        commit('REMOVE_CATEGORY', id)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}