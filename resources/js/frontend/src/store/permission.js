import axios from 'axios'

export function SET_PERMISSIONS(state, permissions) {
    state.permissions = permissions
}

export function SET_ACTIVE_PERMISSION(state, permission) {
    state.activePermission = permission
}

export function ADD_PERMISSION(state, permission) {
    state.permissions = [...state.permissions, permission]
}

export function CHANGE_PERMISSION(state, permission) {
    state.permissions = state.permissions.map(t => t.id == permission.id ? permission : t)
}

export function REMOVE_PERMISSION(state, id) {
    const newList = state.permissions.filter(t => t.id !== id);
    state.permissions = newList;
}

export async function fetchPermissions({ commit }) {
    try {
        const response = await axios.get('/api/permission')
        commit('SET_PERMISSIONS', response.data.permissions)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function fetchPermission({ commit }, { id }) {
    try {
        const response = await axios.get('/api/permission/' + id)
        commit('SET_ACTIVE_PERMISSION', response.data.permission)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function createPermission({ commit }, permission) {
    try {
        const response = await axios.post('/api/permission', permission)
        commit('ADD_PERMISSION', response.data.permission)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function updatePermission({ commit }, permission) {
    try {
        const response = await axios.put('/api/permission/' + permission.id, permission)
        commit('CHANGE_PERMISSION', response.data.permission)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function deletePermission({ commit }, { id }) {
    try {
        const response = await axios.delete('/api/permission/' + id)
        commit('REMOVE_PERMISSION', id)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}