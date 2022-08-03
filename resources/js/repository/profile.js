class ProfileRepository {
    refreshCsrfToken() {
        return axios.get("/sanctum/csrf-cookie");
    }

    async update(data) {

        await this.refreshCsrfToken();

        return (await axios.put('/user/profile-information', data)).data
    }

    async updatePassword(data) {

        await this.refreshCsrfToken();

        return (await axios.put('/user/password', data))
    }
}

export default new ProfileRepository();
