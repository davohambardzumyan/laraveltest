class TicketRepository {
    refreshCsrfToken() {
        return axios.get("/sanctum/csrf-cookie");
    }

    async getList() {
        return (await axios.get('/tickets')).data
    }

    async getAllUsers() {
        return (await axios.get('/tickets/get-all-users')).data
    }

    async create(data) {
        return (await axios.post('/tickets/create', data)).data
    }
}

export default new TicketRepository();
