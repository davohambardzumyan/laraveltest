<template>
    <auth-layout>
        <v-card>
            <v-card-text>
                <v-form
                    ref="form"
                    lazy-validation
                    @submit.prevent="submit"
                    aria-label="Login"
                    class="mb-3"
                >
                    <v-text-field
                        v-model="form.email"
                        :rules="[rules.required,rules.email]"
                        :error-messages="errorMessages.email"
                        @input="clearErrorMessage('email')"
                        label="E-mail address"
                        class="required"
                    ></v-text-field>

                    <v-btn
                        :loading="isLoading"
                        block
                        type="submit"
                        color="primary"
                        class="mt-5 mb-5"
                    >
                        Send
                    </v-btn>
                </v-form>
                <auth-form-footer/>
            </v-card-text>
        </v-card>
    </auth-layout>
</template>

<script>
import auth from "../../repository/auth";
import AuthLayout from "../_layouts/AuthLayout";
import loading from "../../mixins/loading";
import AuthFormFooter from "./components/AuthFormFooter";
import errorMessages from "../../mixins/error-messages";
import validation from "../../mixins/validation";

export default {
    name: "ForgotPassword",
    components: {AuthFormFooter, AuthLayout},
    mixins: [
        loading,
        errorMessages,
        validation
    ],
    data() {
        return {
            form: {
                email: null
            }
        }
    },
    methods: {
        async submit() {
            if (this.$refs.form.validate()) {
                this.startLoading()
                await auth.forgotPassword(this.form).then(async (data) => {
                    this.$toast.success(data.message)
                    await this.$router.push('/login')
                }).catch(({response}) => {
                    this.setErrorMessages(response.data.errors)
                }).finally(() => {
                    this.stopLoading()
                })
            }
        }
    },
}
</script>
