import axios from 'axios'

export function SET_TRANSACTIONS(state, transactions) {
    state.transactions = transactions
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

export async function fetchTransactions({ commit }) {
    try {
        const response = await axios.get('/api/transaction')
        commit('SET_TRANSACTIONS', response.data.transactions)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function fetchTransaction({ commit }, { id }) {
    try {
        const response = await axios.get('/api/transaction/' + id)
        commit('SET_ACTIVE_TRANSACTION', response.data.transaction)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function createTransaction({ commit }, transaction) {
    try {
        const response = await axios.post('/api/transaction', transaction)
        commit('ADD_TRANSACTION', response.data.transaction)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function updateTransaction({ commit }, transaction) {
    try {
        const response = await axios.put('/api/transaction/' + transaction.id, transaction)
        commit('CHANGE_TRANSACTION', response.data.transaction)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}

export async function deleteTransaction({ commit }, { id }) {
    try {
        const response = await axios.delete('/api/transaction/' + id)
        commit('REMOVE_TRANSACTION', id)
    }
    catch (error) {
        alert(error)
        console.log(error)
    }
}