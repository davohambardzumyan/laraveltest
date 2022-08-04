<template>
    <v-main class="main">
        <v-container fluid fill-height>
            <v-layout column align-center justify-center class="white--text">
                <div class="display-4 mb-10">WELCOME</div>
                <v-btn v-if="$store.getters.isAuthenticated" to="/tickets">Member Area</v-btn>
                <v-btn v-else to="/login">Login</v-btn>
            </v-layout>
        </v-container>
    </v-main>
</template>


<script>
export default {
    name: "Home"
}
</script>
