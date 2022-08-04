<template>
    <auth-layout>
        <v-card>
            <v-card-text>
                <login-form
                    :is-loading="isLoading"
                    @submit="submit"
                />
                <auth-form-footer/>
            </v-card-text>
        </v-card>
    </auth-layout>
</template>

<script>
import auth from "../../repository/auth";
import AuthLayout from "../_layouts/AuthLayout";
import loading from "../../mixins/loading";
import LoginForm from "./components/LoginForm";
import AuthFormFooter from "./components/AuthFormFooter";
import errorMessages from "../../mixins/error-messages";

export default {
    name: "Login",
    components: {AuthFormFooter, LoginForm, AuthLayout},
    mixins: [
        loading,
        errorMessages
    ],
    methods: {
        async submit(formData) {
            this.startLoading()
            await auth.login(formData).then(async (data) => {
                this.$store.dispatch('login', data.user).then(() => {
                    this.$router.push({name: 'Tickets'})
                })
            }).catch((error) => {
                this.$toast.error(error.response?.data.message ?? 'Something went wrong.');
            }).finally(() => {
                this.stopLoading()
            })
        }
    },
}
</script>
