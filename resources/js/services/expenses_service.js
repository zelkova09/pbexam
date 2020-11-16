import { http, httpFile } from './http_service';

export function createExpenses(data) {
    return httpFile().post('/expenses', data);
}

export function loadExpenses() {
    return http().get('/expenses');
}

export function deleteExpenses(id) {
    return http().delete(`expenses/${id}`);
}

export function updateExpense(id, data) {
    return httpFile().post(`/expenses/${id}`, data);
}