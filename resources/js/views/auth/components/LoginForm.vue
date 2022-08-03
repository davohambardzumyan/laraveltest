<template>
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
            label="E-mail address"
            class="required"
        ></v-text-field>

        <password
            v-model="form.password"
            :rules="[rules.required]"
            label="Password"
            class="required"
        />

        <v-checkbox
            v-model="form.remember"
            label="Remember me"
        ></v-checkbox>

        <v-btn
            :loading="isLoading"
            block
            type="submit"
            color="primary"
            class="mt-5 mb-5"
        >
            Login
        </v-btn>
    </v-form>
</template>

<script>
import Password from "../../../components/form/Password";
import validation from "../../../mixins/validation";

export default {
    name: "LoginForm",
    components: {Password},
    mixins: [
        validation
    ],
    props: {
        isLoading: {
            type: Boolean,
            required: true
        }
    },
    data() {
        return {
            form: {
                email: "",
                password: "",
                remember: true
            }
        }
    },
    methods: {
        submit() {
            if (this.$refs.form.validate()) {
                this.$emit('submit', this.form)
            }
        }
    }
}
</script>
