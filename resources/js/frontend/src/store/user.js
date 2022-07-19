import axios from 'axios'

export function SET_USERS(state, users) {
    state.users = users
}

export function SET_ACTIVE_USER(state, user) {
    state.activeUser = user
}

export function ADD_USER(state, user) {
    state.users = [...state.users, user]
}

export function CHANGE_USER(state, user) {
    state.users = state.users.map(t => t.id == user.id ? user : t)
}

export function REMOVE_USER(state, id) {
    const newList = state.users.filter(t => t.id !== id);
    state.users = newList;
}

export async function fetchUsers({ commit }) {
    try {
        const response = await axios.get('/api/user')
        commit('SET_USERS', response.data.users)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function fetchUser({ commit }, { id }) {
    try {
        const response = await axios.get('/api/user/' + id)
        commit('SET_ACTIVE_USER', response.data.user)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function createUser({ commit }, user) {
    try {
        const response = await axios.post('/api/user', user)
        commit('ADD_USER', response.data.user)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function updateUser({ commit }, user) {
    try {
        const response = await axios.put('/api/user/' + user.id, user)
        commit('CHANGE_USER', response.data.user)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function deleteUser({ commit }, { id }) {
    try {
        const response = await axios.delete('/api/user/' + id)
        commit('REMOVE_USER', id)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}