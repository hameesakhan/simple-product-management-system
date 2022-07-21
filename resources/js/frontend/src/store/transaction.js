import axios from 'axios'

export function SET_TRANSACTIONS(state, transactions) {
    state.transactions = transactions
}

export function SET_TRANSACTIONS_PAGINATION(state, paginate) {
    state.transactions_total = paginate.total
    state.transactions_per_page = paginate.per_page
}

export function SET_ACTIVE_TRANSACTION(state, transaction) {
    state.activeTransaction = transaction
}

export function ADD_TRANSACTION(state, transaction) {
    state.transactions = [transaction, ...state.transactions]
}

export function CHANGE_TRANSACTION(state, transaction) {
    state.transactions = state.transactions.map(t => t.id == transaction.id ? transaction : t)
}

export function REMOVE_TRANSACTION(state, id) {
    const newList = state.transactions.filter(t => t.id !== id);
    state.transactions = newList;
}

export async function fetchTransactions({ commit }, page = 1) {
    try {
        const response = await axios.get(`/api/transaction?page=${page}`)
        commit('SET_TRANSACTIONS', response.data.transactions.data)
        commit('SET_TRANSACTIONS_PAGINATION', { total: response.data.total, per_page: response.data.per_page })
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}

export async function fetchTransaction({ commit }, { id }) {
    try {
        const response = await axios.get('/api/transaction/' + id)
        commit('SET_ACTIVE_TRANSACTION', response.data.transaction)
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}

export async function createTransaction({ commit }, transaction) {
    try {
        const response = await axios.post('/api/transaction', transaction)
        commit('ADD_TRANSACTION', response.data.transaction)
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}

export async function updateTransaction({ commit }, transaction) {
    try {
        const response = await axios.put('/api/transaction/' + transaction.id, transaction)
        commit('CHANGE_TRANSACTION', response.data.transaction)
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}

export async function deleteTransaction({ commit }, { id }) {
    try {
        const response = await axios.delete('/api/transaction/' + id)
        commit('REMOVE_TRANSACTION', id)
    }
    catch (error) {
        commit('setError', { title: error.response.statusText, data: error.response.data })
        console.log(error)
    }
}