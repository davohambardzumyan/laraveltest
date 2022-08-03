<template>
    <v-form
        ref="form"
        lazy-validation
        @submit.prevent="submit"
        aria-label="Register"
        class="mb-3"
    >
        <h3 class="text-center mb-3">
            Registration
        </h3>

        <v-text-field
            v-model="form.first_name"
            :rules="[rules.required]"
            label="First Name"
            class="required"
        ></v-text-field>

        <v-text-field
            v-model="form.last_name"
            :rules="[rules.required]"
            label="Last Name"
            class="required"
        ></v-text-field>

        <v-text-field
            v-model="form.email"
            :rules="[rules.required,rules.email]"
            :error-messages="errorMessages.email"
            @input="$emit('clearErrorMessages')"
            label="E-mail Address"
            class="required"
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
            label="Confirm Password"
            class="required"
        />

        <v-btn
            :loading="isLoading"
            block
            type="submit"
            color="primary"
            class="mt-5 mb-5"
        >
            Register
        </v-btn>
    </v-form>
</template>

<script>
import Password from "../../../components/form/Password";
import validation from "../../../mixins/validation";

export default {
    name: "RegistrationForm",
    components: {Password},
    mixins: [
        validation,
    ],
    props: {
        isLoading: {
            type: Boolean,
            required: true
        },
        errorMessages: {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            form: {
                first_name: "",
                last_name: "",
                email: "",
                password: "",
                password_confirmation: "",
            }
        }
    },
    methods: {
        submit() {
            if (this.$refs.form.validate()) {
                this.$emit('submit', this.form)
            }
        },
    }
}
</script>

