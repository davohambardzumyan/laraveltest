<template>
    <dashboard-layout>
        <v-card height="auto" width="auto" class="ma-5 pa-5">
            <v-form ref="profileForm" @submit.prevent="submit">
                <v-container>
                    <v-row>
                        <v-col
                            cols="12"
                            md="4"
                        >
                            <v-text-field
                                v-model="form.first_name"
                                :rules="[rules.required]"
                                label="First Name"
                                class="required"
                            ></v-text-field>
                        </v-col>

                        <v-col
                            cols="12"
                            md="4"
                        >
                            <v-text-field
                                v-model="form.last_name"
                                :rules="[rules.required]"
                                label="Last Name"
                                class="required"
                            ></v-text-field>
                        </v-col>

                        <v-col
                            cols="12"
                            md="4"
                        >
                            <v-text-field
                                v-model="form.email"
                                :rules="[rules.required,rules.email]"
                                label="E-mail Address"
                                class="required"
                            ></v-text-field>
                        </v-col>
                        <v-col
                            cols="12"
                            md="1"
                            class="float-end"
                        >
                            <v-btn :loading="loading" type="submit">Save</v-btn>
                        </v-col>
                    </v-row>
                </v-container>
            </v-form>
        </v-card>
        <v-card height="auto" width="auto" class="ma-5 pa-5">
            <v-container>
                <div class="text-center">
                    <v-btn @click="showChangePasswordDialog">Change Password</v-btn>
                </div>
            </v-container>
        </v-card>

        <v-dialog
            v-model="dialog"
            persistent
            max-width="600px"
        >
            <v-card>
                <v-form ref="passwordForm" @submit.prevent="submitChangePassword">
                    <v-card-title>
                        <span class="text-h5">Change Password</span>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-row>
                                <v-col
                                    cols="12"
                                    md="4"
                                >
                                    <password
                                        v-model="form.current_password"
                                        :rules="[rules.required,rules.password]"
                                        :error-messages="errorMessages.current_password"
                                        @input="clearErrorMessages"
                                        label="Current Password"
                                        class="required"
                                    />
                                </v-col>
                                <v-col
                                    cols="12"
                                    md="4"
                                >
                                    <password
                                        v-model="form.password"
                                        :rules="[rules.required,rules.password]"
                                        label="New Password"
                                        class="required"
                                    />
                                </v-col>
                                <v-col
                                    cols="12"
                                    md="4"
                                >
                                    <password
                                        v-model="form.password_confirmation"
                                        :rules="[rules.required,rules.match(form.password,form.password_confirmation,'Passwords')]"
                                        label="Confirm New Password"
                                        class="required"
                                    />
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="blue darken-1"
                            text
                            @click="dialog = false"
                        >
                            Close
                        </v-btn>
                        <v-btn
                            color="blue darken-1"
                            text
                            type="submit"
                            :loading="loading"
                        >
                            Save
                        </v-btn>
                    </v-card-actions>
                </v-form>
            </v-card>
        </v-dialog>
    </dashboard-layout>
</template>

<script>

import DashboardLayout from "./_layouts/DashboardLayout";
import validation from "../mixins/validation";
import Password from "../components/form/Password";
import profile from '../repository/profile';
import loading from "../mixins/loading";
import errorMessages from "../mixins/error-messages";

export default {
    name: "Profile",
    components: {DashboardLayout, Password},
    mixins: [
        validation,
        loading,
        errorMessages
    ],
    data() {
        return {
            form: {...this.$store.getters.user, current_password: '', password: '', password_confirmation: ''},
            dialog: false
        }
    },
    methods: {
        async submit() {
            if (this.$refs.profileForm.validate()) {
                this.startLoading();
                await profile.update(this.form).then((data) => {
                    this.$toast.success("Profile successfully updated.")
                }).finally(() => {
                    this.stopLoading();
                });
            }
        },
        showChangePasswordDialog() {
            this.dialog = true;
        },
        async submitChangePassword() {
            if (this.$refs.passwordForm.validate()) {
                this.startLoading();
                await profile.updatePassword(this.form).then((data) => {
                    this.$toast.success("Password successfully updated.")
                    this.dialog = false
                }).catch((data)=>{
                    this.setErrorMessages(data.response.data.errors)
                }).finally(() => {
                    this.stopLoading();
                });
            }
        },
    }
}
</script>
