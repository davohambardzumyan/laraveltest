<template>
    <auth-layout>
        <v-card>
            <v-card-text>
                <v-form
                    ref="form"
                    lazy-validation
                    @submit.prevent="submit"
                    aria-label="Reset Password"
                    class="mb-3"
                >
                    <v-text-field
                        v-model="form.email"
                        label="E-mail address"
                        class="required"
                        disabled
                    ></v-text-field>

                    <password
                        v-model="form.password"
                        :rules="[rules.required,rules.password]"
                        label="Password"
                        class="required"
                    />
                    <password
                        v-model="form.password_confirmation"
                        :rules="[rules.required,rules.match(form.password,form.password_confirmation,'Passwords')]"
                        label="Confirm password"
                        class="required"
                    />

                    <v-btn
                        :loading="isLoading"
                        block
                        type="submit"
                        color="primary"
                        class="mt-5 mb-5"
                    >
                        Reset Password
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
import Password from "../../components/form/Password";
import validation from "../../mixins/validation";
import {urlParams} from "../../helpers/_url";
import {abort, isEmail} from "../../helpers/_global";

export default {
    name: "ResetPassword",
    components: {AuthFormFooter, AuthLayout, Password},
    mixins: [
        loading,
        validation,
    ],
    data() {
        return {
            form: {
                email: urlParams.email,
                token: urlParams.token,
                password: "",
                password_confirmation: ""
            }
        }
    },
    mounted() {
        if (!isEmail(this.form.email) || !this.form.token) {
            abort(404)
        }
    },
    methods: {
        async submit() {
            if (this.$refs.form.validate()) {
                this.startLoading()
                await auth.resetPassword(this.form).then(async (data) => {
                    this.$toast.success(data.message)
                }).catch((error) => {
                    this.$toast.error(error.response.data.message)
                }).finally(() => {
                    this.stopLoading()
                    this.$router.push({name: "Login"})
                })
            }
        }
    },
}
</script>
