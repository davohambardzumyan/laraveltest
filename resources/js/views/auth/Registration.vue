<template>
    <auth-layout>
        <v-card>
            <v-card-text>
                <registration-form
                    :is-loading="isLoading"
                    :error-messages="errorMessages"
                    @clearErrorMessages="clearErrorMessages"
                    @submit="submit"
                />
                <auth-form-footer/>
            </v-card-text>
        </v-card>    </auth-layout>
</template>

<script>
import AuthLayout from "../_layouts/AuthLayout";
import AuthFormFooter from "./components/AuthFormFooter";
import loading from "../../mixins/loading";
import errorMessages from "../../mixins/error-messages";
import auth from "../../repository/auth";
import RegistrationForm from "./components/RegistrationForm";

export default {
    name: "Registration",
    components: {RegistrationForm, AuthFormFooter, AuthLayout},
    mixins: [
        loading,
        errorMessages
    ],
    methods: {
        async submit(formData) {
            this.startLoading()
            await auth.register(formData).then(async (data) => {
                this.$store.dispatch('login', data.user).then(() => {
                    this.$router.push({name: 'Dashboard'})
                })
            }).catch((error) => {
                this.setErrorMessages(error.response.data.errors)
            }).finally(() => {
                this.stopLoading()
            })
        }
    },
}
</script>
