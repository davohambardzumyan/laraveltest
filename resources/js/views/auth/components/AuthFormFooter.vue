<template>
    <v-layout>
        <v-flex text-xs-left>
            <v-btn :to="{name:firstButtonRoute.name}" depressed small class="ma-0">
                {{ firstButtonRoute.text }}
            </v-btn>
        </v-flex>
        <v-flex text-xs-right>
            <v-btn :to="{name:secondButtonRoute.name}" depressed small class="ma-0 float-end">
                {{ secondButtonRoute.text }}
            </v-btn>
        </v-flex>
    </v-layout>
</template>

<script>
export default {
    name: "AuthFormFooter",
    computed: {
        firstButtonRoute() {
            switch (this.$router.currentRoute.name) {
                case "Login":
                    return {
                        name: "Registration",
                        text: "Register"
                    };
                case "ForgotPassword":
                    return {
                        name: "Registration",
                        text: "Register"
                    };
                case "Registration":
                    return {
                        name: "ForgotPassword",
                        text: "Forgot Password"
                    };
                case "ResetPassword":
                    return {
                        name: "Registration",
                        text: "Register"
                    };
            }
        },
        secondButtonRoute() {
            switch (this.$router.currentRoute.name) {
                case "Login":
                    return {
                        name: "ForgotPassword",
                        text: "Forgot Password"
                    };
                case "ForgotPassword":
                    return {
                        name: "Login",
                        text: "Back to Login"
                    };
                case "Registration":
                    return {
                        name: "Login",
                        text: "Back to Login"
                    };
                case "ResetPassword":
                    return {
                        name: "Login",
                        text: "Login"
                    };
            }
        }
    }
}
</script>
