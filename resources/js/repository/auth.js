class AuthRepository{
    refreshCsrfToken() {
        return axios.get("/sanctum/csrf-cookie");
    }

    async login(credentials) {

        await this.refreshCsrfToken();

        return (await axios.post('/login',credentials)).data
    }

    async me() {
        await this.refreshCsrfToken();

        return (await axios.get('/me'))
    }

    async logout() {
        await this.refreshCsrfToken();

        return (await axios.post('/logout',{}))
    }

    async forgotPassword(formData) {
        await this.refreshCsrfToken();

        return (await axios.post('/forgot-password',formData)).data
    }

    async resetPassword(formData) {
        await this.refreshCsrfToken();

        return (await axios.post('/reset-password',formData)).data
    }

    async register(formData) {
        return (await axios.post('/register',formData)).data
    }

}

export default new AuthRepository();
